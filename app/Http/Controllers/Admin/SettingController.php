<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $settings = $settings->toArray();

        view()->share('page_title', 'Settings');
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $settings = array_filter($request->all());
        foreach ($settings as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        session()->flash('success', 'Settings updated successfully.');
        return redirect(url('admin/settings'));
    }
}
