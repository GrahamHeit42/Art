<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use App\Models\Post;
use App\Models\Subject;
use App\Models\Username;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        view()->share('page_title', 'Posts');
        $posts = Post::latest()->limit(30)->with('images')->get();
        return response()->json([
            'status' => TRUE,
            'posts' => $posts
        ]);
    }

    public function create($type=null)
    {
        view()->share('page_title', 'Create Post');
        $subjects = Subject::whereStatus(1)->get();
        $mediums = Medium::whereStatus(1)->get();
        return view('frontend.posts.create', compact('type', 'subjects', 'mediums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'owner_name' => 'required',
            'subject_id' => 'required',
            'medium_id' => 'required'
        ]);

        $postId = $request->post('id');
        $postType = $request->post('type');
        $drawnBy = NULL;
        $commissionedBy = NULL;
        if($postType === 'commissioner') {
            $drawnBy = Username::where('username', $request->post('owner_name'))->first()->user_id ?? NULL;
        }
        else {
            $commissionedBy = User::where('display_name', $request->post('owner_name'))->first()->id ?? NULL;
        }

        $post = Post::updateOrCreate(
            ['id' => $postId],
            [
                'user_id' => auth()->id(),
                'drawn_by' => $drawnBy,
                'commissioned_by' => $commissionedBy,
                'subject_id' => $request->post('subject_id'),
                'medium_id' => $request->post('medium_id'),
                'title' => $request->post('title'),
                'description' => $request->post('description'),
                'keywords' => $request->post('keywords'),
                'price' => $request->post('price'),
                'speed' => $request->post('speed'),
                'quality' => $request->post('quality'),
                'communication' => $request->post('communication'),
                'transaction' => $request->post('transaction'),
                'concept' => $request->post('concept'),
                'understanding' => $request->post('understanding'),
                'want_work_again' => $request->post('want_work_again'),
                'status' => 1
            ]
        );

        if($post) {
            session()->flash('success', 'Post created successfully.');
            return redirect(url('posts/' . $post->id));
        }

        session()->flash('error', 'Something went wrong, Please try again.');
        return redirect()->back();
    }

    public function show($id)
    {
        view()->share('page_title', 'Post Information');
        $post = Post::with('images')->find($id);

        return view('frontend.posts.show', compact('post'));
    }
}
