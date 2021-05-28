<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Medium;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use App\Models\Username;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\PostView;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /*public function index(): JsonResponse
    {
        view()->share('page_title', 'Posts');
        $posts = Post::latest()->limit(30)->with('images')->get();

        return response()->json([
            'status' => TRUE,
            'posts' => $posts
        ]);
    }*/

    public function create($type = NULL)
    {
        view()->share('page_title', 'Create Post');
        $subjects = Subject::whereStatus(1)->get();
        $mediums = Medium::whereStatus(1)->get();
        $usernames = Username::all();

        return view('frontend.posts.create', compact('type', 'subjects', 'mediums', 'usernames'));
    }

    public function store(Request $request)
    {
        // dd($request->file('images'));
        if ($request->ajax()) {
            $request->validate([
                'type' => 'required',
                'subject_id' => 'required',
                'medium_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                // 'images' => 'required',
            ]);
            // dd("stop");
            if ($request->post('type') === config('constants.Commissioner') || $request->post('type') === config('constants.Commisioned')) {
                $request->validate([
                    'username' => 'required',
                ]);
            }

            $postId = $request->post('id');
            $postType = $request->post('type');

            if (!empty($request->post('username'))) {
                $username = $request->post('username');

                if (!is_numeric($username)) {
                    $update_username = Username::updateOrCreate(
                        [
                            'username' => $username
                        ],
                        [
                            'user_id' => NULL,
                            'created_by' => auth()->id()
                        ]
                    );
                    $username = $update_username->id;
                }
            }
            /*
            $username = Username::updateOrCreate(
                        [
                            'username' => $username
                        ],
                        [
                            'user_id' => NULL,
                            'created_by' => auth()->id()
                        ]
                    );
            */

            // $drawnBy = ($postType === config('constants.Commissioner')) ? $username->id : NULL;
            // $commissionedBy = ($postType === config('constants.Commisioned')) ? $username->id : NULL;

            $getUsername = Username::select('id')->where('user_id', auth()->id())->latest()->first();

            if ($postType === config('constants.Commissioner')) {
                $drawnBy = $username ?? NULL;
                $commissionedBy = $getUsername->id  ?? NULL;
            } else if ($postType === config('constants.Commisioned')) {
                $drawnBy = $getUsername->id  ?? NULL;
                $commissionedBy = $username ?? NULL;
            } else if ($postType === config('constants.Artist')) {
                $drawnBy = $getUsername->id ?? NULL;
                $commissionedBy = NULL;
            }

            $postData = $request->post();
            $postData['drawn_by'] = $drawnBy;
            $postData['commisioned_by'] = $commissionedBy;
            $postData['user_id'] = auth()->id();
            $postData['keywords'] = implode(',', $request->post('keywords', [])) ?? NULL;
            $postData['status'] = 1;
            if (isset($request->work_again)) {
                $postData['want_work_again'] = $request->work_again;
            }

            if ($request->hasFile('cover_image')) {
                $year = Carbon::now()->format('Y');
                $month = Carbon::now()->format('m');
                $coverImage = $request->file('cover_image');
                $fileName = (time() + 10) . '.' . $coverImage->getClientOriginalExtension();
                $coverImage->storeAs('posts/cover_images/' . $year . '/' . auth()->id(), $fileName);
                $path = 'storage/posts/cover_images/' . $year . '/' . auth()->id() . '/' . $fileName;
                $postData['cover_image'] = $path;
            }

            $post = Post::updateOrCreate(
                ['id' => $postId],
                $postData
            );

            if ($post) {
                if ($request->hasFile('images')) {
                    $year = Carbon::now()->format('Y');
                    $month = Carbon::now()->format('m');
                    $images = $request->file('images');
                    foreach ($images as $key => $image) {
                        $fileName = (time() + ($key * 10)) . '.' . $image->getClientOriginalExtension();
                        $image->storeAs('posts/' . $year . '/' . $month . '/' . auth()->id(), $fileName);
                        $path = 'storage/posts/' . $year . '/' . $month . '/' . auth()->id() . '/' . $fileName;
                        Image::create([
                            'post_id' => $post->id,
                            'image_path' => $path,
                            'display_order' => (Image::wherePostId($post->id)->count() + 1)
                        ]);
                    }
                }

                // session()->flash('success', 'Post created successfully.');

                // return redirect(url('posts/' . $post->id));
                return response()->json([
                    'status' => true,
                    'message' => 'Post created successfully.',
                    'id' => $post->id
                ]);
            }
        }

        // session()->flash('error', 'Something went wrong, Please try again.');

        // return redirect()->back();
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }

    public function show($id)
    {
        view()->share('page_title', 'Post Information');
        $post = Post::with('images', 'drawnBy', 'commisionedBy')->find($id);

        $user_id = auth()->id() ?? NULL;
        $count = 0;

        $postview = PostView::updateOrCreate(
            [
                'post_id' => $id,
                'user_id' => $user_id,
            ],
            [
                'count' => DB::Raw('count+1'),
            ]
        );
        $post->views_count = PostView::where('post_id', $id)->sum('count') ?? 0;

        return view('frontend.posts.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        view()->share('page_title', 'Post Edit');

        $subjects = Subject::whereStatus(1)->get();
        $mediums = Medium::whereStatus(1)->get();
        $usernames = Username::all();
        $post = Post::with('images', 'drawnBy', 'commisionedBy')->find($id);
        $getUsernames = Username::select('user_id')->where('id', $post->drawn_by)->first();
        if (empty($post->commisioned_by)) {
            $type = config('constants.Artist');
        } else if ($post->user_id == $getUsernames->user_id) {
            $type = config('constants.Commisioned');
        } else {
            $type = config('constants.Commissioner');
        }

        return view('frontend.posts.edit', compact('post', 'type', 'subjects', 'mediums', 'usernames'));
    }

    public function imageDelete(Request $request)
    {
        if (!empty($request->post('image_path'))) {
            $delete = Image::where('image_path', $request->post('image_path'))->delete();
            if ($delete) {
                return response()->json([
                    'status' => true,
                    'message' => 'Image delete Successfully.',
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }

    public function follow(Request $request)
    {
        $follow_user_id = $request->post('userid');
        $user_id = Auth::user()->id;

        $follow = Follow::create([
            'user_id' => $user_id,
            'follow_user_id' => $follow_user_id,
        ]);
        if ($follow) {
            return response()->json([
                'status' => true,
                'message' => 'Follow changes Successfully.',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }
}
