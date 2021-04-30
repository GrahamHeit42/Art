<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::latest()->limit(30)->with('images')->get();
        return response()->json([
            'status' => TRUE,
            'posts' => $posts
        ]);
    }

    public function create($type=null)
    {
        $subjects = Subject::whereStatus(1)->get();
        $mediums = Medium::whereStatus(1)->get();
        return view('frontend.posts.create', compact('type', 'subjects', 'mediums'));
    }

    public function store()
    {

    }

    public function show($id)
    {
        $post = Post::with('images')->find($id);

        return view('frontend.posts.show', compact('post'));
    }
}
