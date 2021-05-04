<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        view()->share('page_title', 'Users');
        return view('admin.users.index');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('is_admin', '!=', 1)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('profile_image', function($row) {
                    return '<img alt="'.$row->display_name.'" src="'.asset($row->profile_image).'" class="img-thumbnail" style="width: auto; height: 100px;"/>';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("admin/users/" . $row->id) . '" class="btn btn-lg text-info p-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . url("admin/users/edit/" . $row->id) . '" class="btn btn-lg text-warning p-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-lg text-danger p-2 delete" data-id="' . $row->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
                })
                ->rawColumns(['profile_image', 'action'])
                ->make(TRUE);
        }

        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }

    public function createUpdate($id = NULL)
    {
        $user = User::find($id);

        view()->share('page_title', (!empty($id) ? 'Update' : 'Create') . 'User');

        return view('admin.users.create-update', compact('user'));
    }

    public function show($id = NULL)
    {
        $user = User::find($id);

        view()->share('page_title', 'User Details');

        return view('admin.users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $userId = $request->post('id') ?? NULL;

        $request->validate([
            'display_name' => 'required|max:100',
            'username' => 'required|max:100',
            'email' => "required|email|max:200|unique:users,email," . $userId,
            'password' => 'nullable|min:8'
        ]);

        $data = $request->except('profile_image');

        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $fileName = time() .'.'. $profileImage->getClientOriginalExtension();
            $profileImage->storeAs('users', $fileName);
            $data['profile_image'] = 'storage/users/' . $fileName;
        }

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->post('password'));
        }

        $user = User::updateOrCreate(
            ['id' => $userId],
            $data
        );

        if ($user) {
            session()->flash('success', 'User details saved successfully.');

            return redirect(url('admin/users/' . $user->id));
        }
        session()->flash('error', 'Something went wrong, Please try again.');

        return redirect(url('admin/users/' . $user->id));
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $delete = User::destroy($request->post('id'));
            if ($delete) {
                return response()->json([
                    'status' => TRUE,
                    'message' => 'User deleted successfully.'
                ]);
            }
        }

        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }
}
