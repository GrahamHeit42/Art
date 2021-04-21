<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomController;
use App\Models\Image;
use App\Models\Subject;
use App\Models\Medium;
use DataTables;

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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::with('drawnBy')->where('status', 1)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image = "";
                    $img = Image::select('name')->where('post_id', $row->id)->first();
                    if (!empty($img)) {
                        $image = \config('app.asset_url') . $this->getPostImagePath() . $img->name;
                    }
                    return $image;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . url("posts/view", $row->id) . '" class="btn text-info p-2"><i class="fas fa-eye"></i></a>
                    
                    <a href="' . url("posts/update", $row->id) . '" class="btn text-primary p-2"><i class="fas fa-edit"></i></a>

                            <button class="btn open-modal dlt-btn text-danger p-2" data-toggle="modal" data-target="#modal" data-id="$row->id" data-url="' . url("posts/delete", $row->id) . '"><i class="fas fa-trash-alt"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::user()->id)->where('status', 1)->get();
        $subjects = Subject::all();
        $mediums = Medium::all();
        return view('admin.posts.create', compact('users', 'subjects', 'mediums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;

        if (empty($id)) {

            $request->validate([
                "images" => 'required',
                "user_type" => 'required',
                "user_id" => 'required',
                "subject_id" => 'required',
                "medium_id" => 'required',
                "title" => 'required|string|max:255',
                "description" => 'required',

            ]);

            if ($request->user_type == 1) {
                $request->validate([
                    "artist_type" => 'required',
                ]);
            }

            if ($request->form_type == config('constants.AC') || $request->form_type == config('constants.CC')) {
                $request->validate([
                    "work_again" => 'required',
                ]);
            }
            if (!empty($request->keywords)) {
                $keywords = str_replace(' ', ',', $request->keywords);
            }


            $post = new Post;
            $post->user_type = $request->user_type;
            $post->user_id = Auth::user()->id;

            $post->artist_type = $request->artist_type;
            $post->subject_id = $request->subject_id;
            $post->medium_id = $request->medium_id;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->keywords = $keywords;
            $post->status = $request->status;
            $name = $request->user_id;

            if ($request->form_type == config('constants.AC')) {
                $post->a_transaction = $request->a_transaction;
                $post->a_concept = $request->a_concept;
                $post->a_understanding = $request->a_understanding;
                $post->a_communication = $request->a_communication;
                $a_work_again = $request->work_again;
                $post->commisioned_by = $name;
            }
            if ($request->form_type == config('constants.CC')) {
                $post->c_price = $request->c_price;
                $post->c_speed = $request->c_speed;
                $post->c_quality = $request->c_quality;
                $post->c_communication = $request->c_communication;
                $c_work_again = $request->work_again;
                $post->drawn_by = $name;
            }
            $post->a_work_again = $a_work_again ?? null;
            $post->c_work_again = $c_work_again ?? null;


            $save = $post->save();
            if ($save) {
                if (!empty($request->images)) {
                    $images = $request->images;
                    foreach ($images as $image) {
                        Image::create([
                            'post_id' => $post->id,
                            'name' => $image
                        ]);
                    }
                }
            }

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


            $post = Post::find($id);
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
        $post = Post::select('*')->with('userDetails')->with('drawnBy')->with('commisionedBy')->with('subject')->with('medium')->where('id', $id)->first();
        $images = Image::select('name')->where('post_id', $id)->get();

        if (!empty($images)) {
            foreach ($images as $image) {
                $image->name = \config('app.asset_url') . $this->getPostImagePath() . $image->name;
            }
            $post->images = $images;
        }
        // dd($post->drawnBy->first_name);
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
        return view('admin.posts.show');
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
