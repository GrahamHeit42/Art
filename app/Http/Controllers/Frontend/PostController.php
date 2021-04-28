<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => TRUE,
                'posts' => Post::latest()->limit(30)->get()
        ]);
    }

    public function create()
    {
        
    }

    public function store()
    {
        
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('frontend.posts.show', compact('post'));
    }
}
