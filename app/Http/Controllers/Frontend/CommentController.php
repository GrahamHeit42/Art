<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'post_id' => 'required',
                'comment' => 'required',
            ]);

            $comment = new Comment;
            $comment->user_id = $request->post('user_id');
            $comment->post_id = $request->post('post_id');
            $comment->parent_id = $request->post('parent_id') ?? NULL;
            $comment->comment = $request->post('comment');
            $comment->user()->associate($request->user());
            $post = Post::find($request->post('post_id'));

            $post->comments()->save($comment);
            if ($post) {
                return response()->json([
                    'status' => true,
                    'message' => 'Comment added Successfully.'
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }

    public function reply(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'comment' => 'required',
            'comment_id' => 'required',
        ]);

        $reply = new Comment();

        $reply->post_id = $request->get('post_id');
        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back();
    }
}
