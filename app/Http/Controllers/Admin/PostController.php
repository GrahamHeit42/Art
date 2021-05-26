<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function index()
    {
        view()->share('page_title', 'Posts');

        return view('admin.posts.index');
    }

    public function getPosts(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::latest()->with(['user', 'subject', 'medium'])->get();

            return DataTables::of($posts)
                ->addIndexColumn()
                ->editColumn('image_url', function ($row) {
                    if ($row->image_url !== NULL) {
                        return '<img src="' . $row->image_url . '" width="70px" height="70px"/>';
                    } else {
                        return '<img src="' . asset("assets/images/noimage.jpg") . '" width="70px" height="70px"/>';
                    }
                })
                ->addColumn('display_name', function ($row) {
                    return $row->user->display_name ?? NULL;
                })
                ->addColumn('subject_title', function ($row) {
                    return $row->subject->title ?? NULL;
                })
                ->addColumn('medium_title', function ($row) {
                    return $row->medium->title ?? NULL;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("admin/posts/" . $row->id) . '" class="btn btn-lg text-warning p-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-lg text-danger p-2 delete" data-id="' . $row->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
                })
                ->rawColumns(['action', 'image_url'])
                ->makeHidden(['user', 'subject', 'medium'])
                ->make(TRUE);
        }

        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again'
        ]);
    }

    public function show($id = NULL)
    {
        $post = Post::find($id);

        view()->share('page_title', (!empty($id) ? 'Update' : 'Create') . ' Post');

        return view('admin.posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $postId = $request->post('id') ?? NULL;

        $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $postId
        ]);

        $post = Post::updateOrCreate(
            [
                'id' => $postId
            ],
            [
                'title' => $request->post('title'),
                'status' => $request->post('status')
            ]
        );

        if ($post) {
            session()->flash('success', 'Post details updated successfully.');

            return redirect(url('admin/posts') . '/' . $post->id);
        }

        session()->flash('error', 'Something went wrong, Please try again.');

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $delete = Post::destroy($request->post('id'));
            if ($delete) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'Post deleted successfully.'
                ]);
            }
        }

        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }

    /*public function getPostImagePath()
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::with('drawnBy')->where('status', 1)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $image = "";
                    $img = Image::select('name')->where('post_id', $row->id)->first();
                    if (! empty($img)) {
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
                ->make(TRUE);
        }

        return view('admin.posts.index');
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::user()->id)->where('status', 1)->get();
        $subjects = Subject::all();
        $posts = Post::all();

        return view('admin.posts.create', compact('users', 'subjects', 'posts'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if (empty($id)) {

            $request->validate([
                "images" => 'required',
                "user_type" => 'required',
                "user_id" => 'required',
                "subject_id" => 'required',
                "post_id" => 'required',
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
            if (! empty($request->keywords)) {
                $keywords = str_replace(' ', ',', $request->keywords);
            }

            $post = new Post;
            $post->user_type = $request->user_type;
            $post->user_id = Auth::user()->id;

            $post->artist_type = $request->artist_type;
            $post->subject_id = $request->subject_id;
            $post->post_id = $request->post_id;
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
            $post->a_work_again = $a_work_again ?? NULL;
            $post->c_work_again = $c_work_again ?? NULL;

            $save = $post->save();
            if ($save) {
                if (! empty($request->images)) {
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
        }
        else {
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
        }
        else {
            return redirect()->back()->with('errors', config('constants.FAIL'));
        }
    }

    public function show($id)
    {
        $post = Post::select('*')->with('userDetails')->with('drawnBy')->with('commisionedBy')->with('subject')->with('post')->where('id', $id)->first();
        $images = Image::select('name')->where('post_id', $id)->get();

        if (! empty($images)) {
            foreach ($images as $image) {
                $image->name = \config('app.asset_url') . $this->getPostImagePath() . $image->name;
            }
            $post->images = $images;
        }

        // dd($post->drawnBy->display_name);
        return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        return view('admin.posts.show');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->status = 2;
        $post->deleted_at = Date('Y-m-d H:i:s');
        $post->save();

        return redirect('posts')->with('success', config('constants.DELETE_MSG'));
    }*/
}
