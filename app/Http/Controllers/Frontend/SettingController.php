<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        view()->share('page_title', 'Settings');
        $settings = Setting::all()->pluck('value', 'key');
        return response()->json([
            'status' => TRUE,
            'settings' => $settings
        ]);
    }
}
