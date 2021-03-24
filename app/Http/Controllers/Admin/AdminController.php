<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function saveProfile(Request $request)
    {
        $id = $request->id;
        if (empty($id)) {
            return redirect()->back()->withErrors(['User Id Required.']);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email," . $id,
                'phone' => "required|string|unique:users,phone," . $id,
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $save = $user->save();
            if ($save) {
                return redirect('profile')->with('success', 'Profile updated successfully!');
            } else {
                return redirect()->back()->withErrors(['There is some error.']);
            }
        }
    }

    public function changepw()
    {
        return view('changepw');
    }

    public function saveChangepw(Request $request)
    {
        $id = Auth::user()->id;
        if (empty($id)) {
            return redirect()->back()->withErrors(['User Id Required.']);
        } else {
            $request->validate([
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password',
            ]);

            $user = User::find($id);
            $user->password = Hash::make($request->password);
            $save = $user->save();
            if ($save) {
                return redirect('changepw')->with('success', 'Password updated successfully!');
            } else {
                return redirect()->back()->withErrors(['There is some error.']);
            }
        }
    }

    // Artists 
    public function allArtists()
    {
        $artists = User::select()->where('role_id', 2)->where('is_delete', 0)->get();
        return view('admin.artistlist', compact('artists'));
    }

    public function insertArtist()
    {
        return view('admin.artist');
    }

    public function saveArtist(Request $request)
    {
        $id = $request->id;
        if (empty($id)) {
            $request->validate([
                'role_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $save = User::create([
                'role_id' => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'is_active' => 1,
            ]);
            $succ = 'Artist Added Successfully!';
        } else {
            $request->validate([
                'role_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email," . $id,
                'phone' => "required|string|unique:users,phone," . $id,
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            // $user->email = $request->email;
            $user->phone = $request->phone;
            $user->is_active = $request->is_active;
            $save = $user->save();
            $succ = 'Artist Updated Successfully!';
        }

        if ($save) {
            return redirect('artistlist')->with('success', $succ);
        } else {
            return redirect()->back()->with('errors', 'There is some error.');
        }
    }

    public function viewArtist(Request $request, $id)
    {
        $artist = User::select('*')->where('id', $id)->first();
        return view('admin.artist', compact('artist'));
    }

    public function deleteArtist(Request $request, $id)
    {
        $artist = User::find($id);
        $artist->is_active = 0;
        $artist->is_delete = 1;
        $artist->delete_at = Date('Y-m-d H:i:s');
        $artist->save();
        return redirect('artistlist')->with('success', 'Deleted!');
    }

    // Buyers
    public function allBuyers()
    {
        $buyers = User::select()->where('role_id', 3)->where('is_delete', 0)->get();
        return view('admin.buyerlist', compact('buyers'));
    }

    public function insertBuyer()
    {
        return view('admin.buyer');
    }

    public function saveBuyer(Request $request)
    {
        $id = $request->id;
        if (empty($id)) {
            $request->validate([
                'role_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $save = User::create([
                'role_id' => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'is_active' => 1,
            ]);
            $succ = 'Artist Added Successfully!';
        } else {
            $request->validate([
                'role_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => "required|string|email|max:255|unique:users,email," . $id,
                'phone' => "required|string|unique:users,phone," . $id,
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            // $user->email = $request->email;
            $user->phone = $request->phone;
            $user->is_active = $request->is_active;
            $save = $user->save();
            $succ = 'Buyer Updated Successfully!';
        }

        if ($save) {
            return redirect('buyerlist')->with('success', $succ);
        } else {
            return redirect()->back()->with('errors', 'There is some error.');
        }
    }

    public function viewBuyer(Request $request, $id)
    {
        $buyer = User::select('*')->where('id', $id)->first();
        return view('admin.buyer', compact('buyer'));
    }

    public function deleteBuyer(Request $request, $id)
    {
        $buyer = User::find($id);
        $buyer->is_active = 0;
        $buyer->is_delete = 1;
        $buyer->delete_at = Date('Y-m-d H:i:s');
        $buyer->save();
        return redirect('buyerlist')->with('success', 'Deleted!');
    }
}
