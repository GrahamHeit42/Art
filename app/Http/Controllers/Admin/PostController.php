<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomController;

class PostController extends Controller
{
    public function getPostImagePath()
    {
        return '/upload/posts/';
    }
    public function getImagePath()
    {
        $customController = new CustomController;
        return $customController->getImagePath();
    }
    public function getPublicImagePath()
    {
        $customController = new CustomController;
        return $customController->getPublicImagePath();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('userDetails')->get();
        foreach ($posts as $post) {
            if (!empty($post->image)) {
                $post->image = $this->getImagePath() . $post->image;
            }
        }
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin.posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customController = new CustomController;
        $id = $request->id;
        $imagePath = "";

        if (empty($id)) {
            $request->validate([
                "image" => 'required',
                "name" => 'required|string|max:255',
                "title" => 'required|string|max:255',
                "description" => 'required|string',
                "again" => 'required',
                "status" => 'required',
            ]);
            if ($request->type == 'artist') {
                $request->validate([
                    "transaction" => "required",
                    "speed_a" => "required",
                    "communication_a" => "required",
                    "prepertion" => "required",
                    "concept" => "required",
                ]);
            }
            if ($request->type == 'buyer') {
                $request->validate([
                    "price" => 'required',
                    "speed_b" => "required",
                    "communication_b" => "required",
                    "quality" => 'required',
                    "professonalism" => 'required',
                ]);
            }

            if ($files = $request->file('image')) {
                $directoryName = $customController->getPublicImagePath();

                $filePath = $request->input('name') . '_' . time() . '.' . $files->getClientOriginalExtension();
                $move = $files->move($directoryName, $filePath);
                if ($move) {
                    $imagePath = $filePath;
                }
            }

            $post = new Post;
            $post->image = $imagePath;
            $post->user_id = $request->user_id;
            $post->name = $request->name;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->again = $request->again;
            $post->status = $request->status;

            if ($request->type == 'artist') {
                $post->transaction = $request->transaction;
                $post->speed = $request->speed_a;
                $post->communication = $request->communication_a;
                $post->prepertion = $request->prepertion;
                $post->concept = $request->concept;
            }
            if ($request->type == 'buyer') {
                $post->price = $request->price;
                $post->quality = $request->quality;
                $post->professonalism = $request->professonalism;
                $post->speed = $request->speed_b;
                $post->communication = $request->communication_b;
            }

            $save = $post->save();

            $succ = config('constants.INSERT_MSG');
        } else {
            $request->validate([
                "image" => 'required',
                "name" => 'required|string|max:255',
                "title" => 'required|string|max:255',
                "description" => 'required|string|max:255',
                "price" => 'required',
                "speed" => 'required',
                "quality" => 'required',
                "professonalism" => 'required',
                "communication" => 'required',
                "transaction" => 'required',
                "prepertion" => 'required',
                "again" => 'required',
                "status" => 'required',
            ]);

            if ($files = $request->file('image')) {
                $directoryName = $customController->getPublicImagePath();

                $filePath = $request->input('name') . '_' . time() . '.' . $files->getClientOriginalExtension();
                $move = $files->move($directoryName, $filePath);
                if ($move) {
                    $imagePath = $filePath;
                }
            }

            $post = Post::find($id);
            $post->image = $imagePath;
            $post->user_id = Auth::user()->id;
            $post->name = $request->name;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->price = $request->price;
            $post->speed = $request->speed;
            $post->quality = $request->quality;
            $post->professonalism = $request->professonalism;
            $post->communication = $request->communication;
            $post->transaction = $request->transaction;
            $post->prepertion = $request->prepertion;
            $post->again = $request->again;
            $post->status = $request->status;
            $save = $post->save();
            $succ = config('constants.UPDATE_MSG');
        }

        if ($save) {
            return redirect('posts')->with('success', $succ);
        } else {
            return redirect()->back()->with('errors', config('constants.FAIL'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::select('*')->with('userDetails')->where('id', $id)->first();
        // dd($post);
        if (!empty($post->image)) {
            $post->image = $this->getImagePath() . $post->image;
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.posts.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->status = 2;
        $post->deleted_at = Date('Y-m-d H:i:s');
        $post->save();
        return redirect('posts')->with('success', config('constants.DELETE_MSG'));
    }
}
