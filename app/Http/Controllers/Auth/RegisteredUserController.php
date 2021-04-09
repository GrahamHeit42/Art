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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $imagePath = "";
        if ($files = $request->file('profile_image')) {
            $customController = new CustomController;
            $directoryName = $customController->getPublicImagePath();
            if (!is_dir($directoryName)) {
                mkdir($directoryName, 0777, true);
            }

            $filePath = $request->input('first_name') . '_' . time() . $files->getClientOriginalExtension();
            $move = $files->move($directoryName, $filePath);
            if ($move) {
                $imagePath = $filePath;
            }
        }

        Auth::login($user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => 1,
            'profile_image' => $imagePath
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
