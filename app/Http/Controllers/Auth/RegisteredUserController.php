<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CustomController;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|unique:users|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $imagePath = "";
        if ($files = $request->file('path')) {
            $customController = new CustomController;
            $directoryName = $customController->getPublicImagePath();
            if (!is_dir($directoryName)) {
                mkdir($directoryName, 0777, true);
            }

            $filePath = $request->input('username') . '_' . time() . $files->getClientOriginalName();
            $move = $files->move($directoryName, $filePath);
            if ($move) {
                $imagePath = $filePath;
            }
        }

        Auth::login($user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'status' => 1,
            'path' => $imagePath
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
