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

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $mediums = Medium::whereStatus(1)->get();
        $subjects = Subject::whereStatus(1)->get();
        $posts = Post::latest();
        view()->share('page_title', 'Home');

        if (!empty($request->get('sid'))) {
            $posts = $posts->where('subject_id', $request->get('sid'));
        }
        if (!empty($request->get('mid'))) {
            $posts = $posts->where('medium_id', $request->get('mid'));
        }

        $posts = $posts->get();
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
