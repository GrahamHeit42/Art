<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomController extends Controller
{
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
        if (!empty($user->path)) {
            $user->path = $this->getImagePath() . $user->path;
        }
        return view('profile', compact('user'));
    }

    public function profileImageDelete($id)
    {
        $user = User::find($id);
        $delete = $this->UnlinkImage($this->getPublicImagePath(), $user->path);
        if ($delete) {
            $user->path = "";
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
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        if ($files = $request->file('path')) {
            $directoryName = $this->getPublicImagePath();

            $filePath = $request->input('username') . '_' . time() . $files->getClientOriginalName();
            $move = $files->move($directoryName, $filePath);
            if ($move) {
                $user->path = $filePath;
            }
        }
        $save = $user->save();
        if ($save) {
            return redirect('profile')->with('success', config('constants.PROFILE_SUCCESS'));
        } else {
            return redirect()->back()->withErrors([config('constants.FAIL')]);
        }
    }
}
