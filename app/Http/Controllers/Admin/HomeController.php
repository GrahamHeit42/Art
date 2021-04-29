<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $summary = [
            'subjects' => Subject::count(),
            'mediums' => Medium::count(),
            'users' => User::count(),
            'posts' => Post::count()
        ];
        view()->share('page_title', 'Dashboard');
        return view('admin.dashboard', compact('summary'));
    }
}
