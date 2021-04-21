<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subject;
use App\Models\Medium;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

class PostController extends Controller
{
    /*
    *
    * Artist Personal Post Page Open
    */
    public function artistPersonalCreate()
    {
        $subjects = Subject::select('id', 'type')->where('is_active', 1)->get();
        $mediums = Medium::select('id', 'type')->where('is_active', 1)->get();
        $page = config('constants.AP');
        return view('frontend.posts.new-post-artist', compact('page', 'subjects', 'mediums'));
    }
    /*
    *
    * Artist Commissioned Post Page Open
    */
    public function artistCommissionedCreate()
    {
        $subjects = Subject::select('id', 'type')->where('is_active', 1)->get();
        $mediums = Medium::select('id', 'type')->where('is_active', 1)->get();
        $users = User::where('is_admin', 0)->get();
        $page = config('constants.AC');
        return view('frontend.posts.new-post-artist', compact('page', 'subjects', 'mediums', 'users'));
    }
    /*
    *
    * Commissioner Post Page Open
    */
    public function commissionerCreate()
    {
        $subjects = Subject::select('id', 'type')->where('is_active', 1)->get();
        $mediums = Medium::select('id', 'type')->where('is_active', 1)->get();
        $users = User::where('is_admin', 0)->get();
        return view('frontend.posts.new-post-commissioner', compact('subjects', 'mediums', 'users'));
    }

    /**
     * Save a newly created post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePost(Request $request)
    {
        // dd($request);
        $id = $request->id;

        if (empty($id)) {

            $request->validate([
                "images" => 'required',
                "user_type" => 'required',
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
            $post->status = 1;
            if (!empty($request->user_id)) {
                $name = $request->user_id;
            }

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
                        $imageName = time() . uniqid() . '.' . $image->extension();
                        $directoryName = public_path('/upload/posts');
                        $move = $image->move($directoryName, $imageName);
                        if ($move) {
                            Image::create([
                                'post_id' => $post->id,
                                'name' => $imageName
                            ]);
                        }
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
}
