<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // view load
        $users = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // creaete view
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            if ($request->file('profile_image')) {
                $user->profile_image = $imagePath;
            }
            if (!empty($password)) {
                $user->password = Hash::make($request->password);
            }
            $user->status = $request->status;
            $save = $user->save();
            $succ = config('constants.UPDATE_MSG');
        }

        if ($save) {
            return redirect('users')->with('success', $succ);
        } else {
            return redirect()->back()->with('errors', config('constants.FAIL'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::select('*')->where('id', $id)->first();
        if (!empty($user->profile_image)) {
            $customController = new CustomController;
            $user->profile_image = $customController->getImagePath() . $user->profile_image;
        }
        return view('admin.users.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 2;
        $user->deleted_at = Date('Y-m-d H:i:s');
        $user->save();
        return redirect('users')->with('success', config('constants.DELETE_MSG'));
    }
    /**
     * Delete user profile image
     *
     * @param  \App\Models\User  $id
     * @return json response
     */
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
