<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomController extends Controller
{
    public function getDashboard()
    {
        if (Auth::user()->is_admin == 1) {
            $usersCount = User::all()->count();
            return view('admin.dashboard', compact('usersCount'));
        } else {
            return view('user.dashboard');
        }
    }
    public function getImagePath()
    {
        return '/upload/images/';
    }

    public function getPublicImagePath()
    {
        return public_path() . $this->getImagePath();
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        if (!empty($user->profile_image)) {
            $user->profile_image = $this->getImagePath() . $user->profile_image;
        }
        if (Auth::user()->is_admin == 1) {
            return view('admin.profile', compact('user'));
        } else {
            return view('profile', compact('user'));
        }
    }

    public function profileImageDelete($id)
    {
        $user = User::find($id);
        $delete = $this->UnlinkImage($this->getPublicImagePath(), $user->profile_image);
        if ($delete) {
            $user->profile_image = "";
            $user->save();
            $succ = 'success';
            $msg = "success";
        } else {
            $succ = 'errors';
            $msg = "fail";
        }

        return response()->json(['success' => $succ, 'message' => $msg()], 200);
    }

    public function UnlinkImage($filepath, $fileName)
    {
        $old_image = $filepath . $fileName;
        if (file_exists($old_image)) {
            @unlink($old_image);
            return true;
        }
        return false;
    }

    public function saveProfile(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        if ($files = $request->file('profile_image')) {
            $directoryName = $this->getPublicImagePath();

            $filePath = $request->input('first_name') . '_' . time() . $files->getClientOriginalName();
            $move = $files->move($directoryName, $filePath);
            if ($move) {
                $user->profile_image = $filePath;
            }
        }
        $save = $user->save();
        if ($save) {
            return redirect('profile')->with('success', config('constants.PROFILE_SUCCESS'));
        } else {
            return redirect()->back()->withErrors([config('constants.FAIL')]);
        }
    }

    public function changePassword()
    {
        if (Auth::user()->is_admin == 1) {
            return view('admin.changePassword');
        } else {
            return view('changePassword');
        }
    }

    public function saveChangePassword(Request $request)
    {
        $id = Auth::user()->id;
        if (empty($id)) {
            return redirect()->back()->withErrors([config('constants . USER_ID_REQUIRED')]);
        } else {
            $request->validate([
                'old_password' => 'required|string|min:8',
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password',
            ]);

            $user = User::find($id);
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors([config('constants.OLD_PASSWORD_NOT_MATCH')]);
            }
            $user->password = Hash::make($request->password);
            $save = $user->save();
            if ($save) {
                return redirect()->back()->with('success', config('constants.PASSWORD_SUCCESS'));
            } else {
                return redirect()->back()->withErrors([config('constants . FAIL')]);
            }
        }
    }
}
