<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomController extends Controller
{
    /**
     * Dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function getDashboard()
    {
        if (Auth::user()->is_admin == 2) {
            $users = User::where(function ($query) {
                $query->where('is_admin', 0)
                    ->orWhere('is_admin', 1);
            })->count();
            $activeUsers = User::where(function ($query) {
                $query->where('is_admin', 0)
                    ->orWhere('is_admin', 1);
            })->where('status', 1)->count();
            $posts = Post::all()->count();

            return view('admin.dashboard', compact('users', 'activeUsers', 'posts'));
        } else if (Auth::user()->is_admin == 1) {
            $users = User::where('is_admin', 0)->count();
            $activeUsers = User::where('is_admin', 0)->where('status', 1)->count();
            return view('admin.dashboard', compact('users', 'activeUsers'));
        } else {
            return view('frontend.dashboard');
        }
    }
    /**
     * Get image store path.
     *
     * @return string
     */
    public function getImagePath()
    {
        return '/upload/images/';
    }
    /**
     * Get public image store path.
     *
     * @return string
     */
    public function getPublicImagePath()
    {
        return public_path() . $this->getImagePath();
    }
    /**
     * Profile view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = User::find(Auth::id());
        if (!empty($user->profile_image)) {
            $user->profile_image = $this->getImagePath() . $user->profile_image;
        }
        if (Auth::user()->is_admin == 0) {
            return view('frontend.users.profile', compact('user'));
        } else {
            return view('admin.profile', compact('user'));
        }
    }
    /**
     * Delete profile image.
     *
     * @return json response
     */
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
    /**
     * Unlink image.
     *
     * @return json response
     */
    public function UnlinkImage($filepath, $fileName)
    {
        $old_image = $filepath . $fileName;
        if (file_exists($old_image)) {
            @unlink($old_image);
            return true;
        }
        return false;
    }
    /**
     * Upload file.
     *
     * @return json response
     */
    public static function uploadFile($files, $directoryName, $filePath)
    {
        $move = $files->move($directoryName, $filePath);
        if ($move) {
            return true;
        }
        return false;
    }
    /**
     * Update Profile.
     *
     * @return \Illuminate\View\View
     */
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
    /**
     * Change Password view.
     *
     * @return \Illuminate\View\View
     */
    public function changePassword()
    {
        if (Auth::user()->is_admin == 0) {
            return view('frontend.users.changePassword');
        } else {
            return view('admin.changePassword');
        }
    }
    /**
     * Update Password.
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        return view('dropzone');
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        return response()->json(['success' => $imageName]);
    }
}
