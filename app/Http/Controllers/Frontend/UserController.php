<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Username;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function profile()
    {
        view()->share('page_title', 'User Profile');

        return view('frontend.users.profile');
    }

    public function settings(Request $request)
    {
        view()->share('page_title', 'User Settings');
        $user = User::find(auth()->id());
        if (Str::lower($request->method()) === 'post') {
            $request->validate([
                'display_name' => 'required',
                // 'username' => 'required|unique:usernames,username,NULL,id,user_id,' . $user->id,
                'username' => 'required',
                'email' => 'required|unique:users,email,' . $user->id
            ]);

            $existUsername = Username::where('username', $request->username)->first();
            if (empty($existUsername)) {
                $username = Username::where('user_id', $user->id)->first();
                if (!empty($username)) {
                    $username->username = $user->username;
                    $username->save();
                }
            }
            if (!empty($existUsername) && $existUsername->user_id !== auth()->id()) {
                // session()->flash('error', 'Username already taken.');
                return redirect(url('settings'))->withErrors(['Username already taken.']);
            }

            $user->display_name = $request->display_name;
            $user->username = $request->username;

            if ($request->hasFile('profile_image')) {
                if (File::exists(public_path($user->profile_image))) {
                    File::delete(public_path($user->profile_image));
                }

                $profile_image = $request->file('profile_image');
                $fileName = (time() + 10) . '.' . $profile_image->getClientOriginalExtension();
                $profile_image->storeAs('users', $fileName);
                $path = 'storage/users/' . $fileName;
                $user->profile_image = $path;
            }
            $user->save();
            session()->flash('success', 'User details updated successfully');

            return redirect(url('settings'));
        }

        return view('frontend.users.settings', compact('user'));
    }

    public function changePassword(Request $request)
    {
        view()->share('page_title', 'Change Password');
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/',
        ], [
            'regex' => 'The password format is invalid, It must contain Uppercase, Lowercase, Symbol and Characters'
        ]);

        $user = User::find(auth()->id());
        if (Hash::check($request->post('old_password'), $user->password)) {
            $user->password = Hash::make($request->post('password'));
            $user->save();
            session()->flash('success', 'Password changed successfully');

            return redirect(url('settings'));
        }
        // session()->flash('error', 'Current password is invalid.');

        return redirect(url('settings'))->withErrors(['Current password is invalid.']);
    }
}
