<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = User::find(auth()->id());
        if (Str::lower($request->method()) === 'post') {
            $request->validate([
                'display_name' => 'required',
                'username' => 'required',
                'email' => 'required|unique:users,email,' . $user->id
            ]);
            $user->fill($request->except('profile_picture'));
            $user->save();
            session()->flash('success', 'User details updated successfully');

            return redirect(url('profile'));
        }

        return view('frontend.users.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::find(auth()->id());
        if (Hash::check($request->post('old_password'), Hash::make($request->post('password')))) {
            $user->password = Hash::make($request->post('password'));
            $user->save();
            session()->flash('success', 'Password changed successfully');

            return redirect(url('profile'));
        }
        session()->flash('error', 'Current password is invalid');

        return redirect(url('profile'));
    }
}
