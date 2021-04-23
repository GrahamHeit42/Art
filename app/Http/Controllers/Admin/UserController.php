<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->where('id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->where('status', '!=', 2)->get(); // except delete(status 2) data

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('register_at', function ($row) {
                    $register_at = date('M-d-Y g:i:A', strtotime($row->created_at));

                    return $register_at;
                })
                ->addColumn('last_active', function ($row) {
                    if (! empty($row->last_login_at)) {
                        $register_at = date('M-d-Y g:i:A', strtotime($row->last_login_at));
                    }
                    else {
                        $register_at = date('M-d-Y g:i:A', strtotime($row->created_at));
                    }

                    return $register_at;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . url("users/view", $row->id) . '" class="btn text-info p-2"><i class="fas fa-eye"></i></a>

                    <a href="' . url("users/update", $row->id) . '" class="btn text-primary p-2"><i class="fas fa-edit"></i></a>

                            <button class="btn open-modal dlt-btn text-danger p-2" data-toggle="modal" data-target="#modal" data-id="$row->id" data-url="' . url("users/delete", $row->id) . '"><i class="fas fa-trash-alt"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(TRUE);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        // creaete view
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $id = $request->id;

        if (empty($id)) {
            $request->validate([
                'display_name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email",
                'password' => 'required|string|min:8',
                'is_admin' => 'required',
                'status' => 'required',
            ]);

            $imagePath = "";
            if ($files = $request->file('profile_image')) {
                $customController = new CustomController;
                $directoryName = $customController->getPublicImagePath();
                if (! is_dir($directoryName)) {
                    mkdir($directoryName, 0777, TRUE);
                }

                $filePath = $request->input('display_name') . '_' . time() . '.' . $files->getClientOriginalExtension();
                $move = $files->move($directoryName, $filePath);
                if ($move) {
                    $imagePath = $filePath;
                }
            }
            $save = User::create([
                'display_name' => $request->display_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->is_admin,
                'status' => $request->status,
                'profile_image' => $imagePath,
            ]);
            $succ = config('constants.INSERT_MSG');
        }
        else {
            $request->validate([
                'display_name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'is_admin' => 'required',
                'status' => 'required',
                'email' => "required|string|email|max:255|unique:users,email," . $id,
            ]);
            if (! empty($request->password)) {
                $request->validate([
                    'password' => 'required|string|min:8',
                ]);
            }
            $imagePath = "";
            if ($files = $request->file('profile_image')) {

                $filePath = $request->input('display_name') . '_' . time() . '.' . $files->getClientOriginalExtension();
                $move = $files->move(public_path('upload/images'), $filePath);
                if ($move) {
                    $imagePath = $filePath;
                }
            }

            $user = User::find($id);
            $user->display_name = $request->display_name;
            $user->username = $request->username;
            $user->is_admin = $request->is_admin;
            if ($request->file('profile_image')) {
                $user->profile_image = $imagePath;
            }
            if (! empty($password)) {
                $user->password = Hash::make($request->password);
            }
            $user->status = $request->status;
            $save = $user->save();
            $succ = config('constants.UPDATE_MSG');
        }

        if ($save) {
            return redirect('users')->with('success', $succ);
        }
        else {
            return redirect()->back()->with('errors', config('constants.FAIL'));
        }
    }

    public function show($id)
    {
        $user = User::select('*')->where('id', $id)->first();
        if (! empty($user->profile_image)) {
            $customController = new CustomController;
            $user->profile_image = $customController->getPublicImagePath() . $user->profile_image;
        }

        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::select('*')->where('id', $id)->first();
        if (! empty($user->profile_image)) {
            $customController = new CustomController;
            $user->profile_image = $customController->getPublicImagePath() . $user->profile_image;
        }

        return view('admin.users.create', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 2;
        $user->deleted_at = Date('Y-m-d H:i:s');
        $user->save();

        return redirect('users')->with('success', config('constants.DELETE_MSG'));
    }

    public function userImageDelete($id)
    {
        $user = User::find($id);
        $customController = new CustomController;

        $path = public_path() . $customController->getImagePath() . $user->profile_image;
        if (file_exists($path)) {
            unlink($path);

            $user->profile_image = "";
            $user->save();
            $succ = 'success';
            $msg = "success";
        }
        else {
            $succ = 'errors';
            $msg = "fail";
        }

        return response()->json(['success' => $succ, 'message' => $msg], 200);
    }
}
