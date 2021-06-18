<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use App\Models\Post;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Username;

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // dd($request);
        // DB::enableQueryLog();
        $mediums = Medium::whereStatus(1)->get();
        $subjects = Subject::whereStatus(1)->get();
        // $posts = Post::latest();
        $posts = new Post();
        view()->share('page_title', 'Home');

        if (!empty($request->get('sid'))) {
            $posts = $posts->where('subject_id', $request->get('sid'));
        }
        if (!empty($request->get('mid'))) {
            $mid = explode(",", $request->get('mid'));
            $posts = $posts->whereIn('medium_id', $mid);
        }
        if (!empty($request->get('q'))) {
            $q = $request->post('q');
            $posts = $posts->where(function ($query) use ($q) {
                $query->Where('title', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%")
                    ->orWhere('keywords', 'like', "%$q%");
            });
        }
        if (!empty($request->get('c'))) {
            $posts = $posts->where('type_id', 3);
        }
        if (!empty($request->get('p'))) {
            $posts = $posts->withCount('likes')->orderBy('likes_count', 'desc');
        }

        $posts = $posts->latest()->get();
        // dd(DB::getQueryLog());
        // dd($posts);

        return view('frontend.home', compact('mediums', 'subjects', 'posts'));
    }

    /**
     * @return JsonResponse
     */
    public function mediums(): JsonResponse
    {
        $mediums = Medium::whereStatus(1)->get();

        return response()->json([
            'status' => TRUE,
            'mediums' => $mediums
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function subjects(): JsonResponse
    {
        $subjects = Subject::whereStatus(1)->get();

        return response()->json([
            'status' => TRUE,
            'mediums' => $subjects
        ]);
    }
}
