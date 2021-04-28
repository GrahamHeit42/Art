<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $mediums = Medium::whereStatus(1)->get();
        $subjects = Subject::whereStatus(1)->get();
        view()->share('page_title', 'Home Page');

        return view('frontend.home', compact('mediums', 'subjects'));
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
