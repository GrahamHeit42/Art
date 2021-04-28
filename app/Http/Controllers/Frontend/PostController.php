<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
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

    public function create()
    {
        return view('frontend.posts.create');
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
