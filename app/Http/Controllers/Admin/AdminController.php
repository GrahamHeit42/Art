<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function usersList()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin.usersList', compact('users'));
    }

    public function user()
    {
        return view('admin.user');
    }

    public function userSave(Request $request)
    {
        $id = $request->id;

        if (empty($id)) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email",
                'password' => 'required|string|min:8',
                'is_admin' => 'required',
                'status' => 'required',
            ]);

            $imagePath = "";
            if ($files = $request->file('profile_image')) {
                $customController = new CustomController;
                $directoryName = $customController->getPublicImagePath();
                if (!is_dir($directoryName)) {
                    mkdir($directoryName, 0777, true);
                }

                $filePath = $request->input('first_name') . '_' . time() . $files->getClientOriginalName();
                $move = $files->move($directoryName, $filePath);
                if ($move) {
                    $imagePath = $filePath;
                }
            }
            $save = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->is_admin,
                'status' => $request->status,
                'profile_image' => $imagePath,
            ]);
            $succ = config('constants.INSERT_MSG');
        } else {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'is_admin' => 'required',
                'status' => 'required',
                'email' => "required|string|email|max:255|unique:users,email," . $id,
            ]);
            if (!empty($request->password)) {
                $request->validate([
                    'password' => 'required|string|min:8',
                ]);
            }
            $imagePath = "";
            if ($files = $request->file('profile_image')) {
                $customController = new CustomController;
                $directoryName = $customController->getPublicImagePath();

                $filePath = $request->input('first_name') . '_' . time() . $files->getClientOriginalName();
                $move = $files->move($directoryName, $filePath);
                if ($move) {
                    $imagePath = $filePath;
                }
            }

            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->is_admin = $request->is_admin;
            $user->profile_image = $imagePath;
            if (!empty($password)) {
                $user->password = Hash::make($request->password);
            }
            $user->status = $request->status;
            $save = $user->save();
            $succ = config('constants.UPDATE_MSG');
        }

        if ($save) {
            return redirect('usersList')->with('success', $succ);
        } else {
            return redirect()->back()->with('errors', config('constants.FAIL'));
        }
    }

    public function userView(Request $request, $id)
    {
        $user = User::select('*')->where('id', $id)->first();
        if (!empty($user->profile_image)) {
            $customController = new CustomController;
            $user->profile_image = $customController->getImagePath() . $user->profile_image;
        }
        return view('admin.user', compact('user'));
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        $user->status = 2;
        $user->deleted_at = Date('Y-m-d H:i:s');
        $user->save();
        return redirect('usersList')->with('success', config('constants.DELETE_MSG'));
    }

    public function userImageDelete($id)
    {
        $user = User::find($id);
        $customController = new CustomController;
        $delete = $customController->UnlinkImage($customController->getPublicImagePath(), $user->profile_image);

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
}
