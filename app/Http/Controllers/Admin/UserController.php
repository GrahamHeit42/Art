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
        return view('admin.users.index');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('is_admin', '!=', 1)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . url("users/" . $row->id) . '" class="btn btn-info text-info p-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . url("users/edit" . $row->id) . '" class="btn btn-warning text-warning p-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger text-danger p-2" data-id="' . $row->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
                })
                ->rawColumns(['action'])
                ->make(TRUE);
        }

        return response()->json([
            'status' => FALSE,
            'message' => 'Something went wrong, Please try again.'
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function show($id = NULL)
    {
        $user = User::find($id);

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
            $fileName = time() . $profileImage->getClientOriginalExtension();
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

            return redirect(url('users/' . $user->id));
        }
        session()->flash('error', 'Something went wrong, Please try again.');

        return redirect(url('users/' . $user->id));
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->post('id'));
            if ($user) {
                $user->delete();
                session()->flash('success', 'User deleted successfully.');

                return redirect(url('users'));
            }
        }
        session()->flash('error', 'Something went wrong, Please try again.');

        return redirect(url('users/'));
    }
}
