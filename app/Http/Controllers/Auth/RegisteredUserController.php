<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Username;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CustomController;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create()
    {
        // return view('auth.register');
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'display_name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|confirmed|min:8|regex:/^(?=.?[A-Z])(?=.?[a-z])(?=.?[0-9])(?=.?[#?!@$%^&*-]).{8,}$/',
            'password' => 'required|string|confirmed|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/',
        ], [
            'regex' => 'The password format is invalid, It must contain Uppercase, Lowercase, Symbol and Characters'
        ]);

        /*$imagePath = NULL;
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
        }*/

        $user = User::create([
            'display_name' => $request->post('display_name'),
            'username' => $request->post('email'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'status' => 0,
            'profile_image' => NULL, // $imagePath
        ]);

        try {
            Username::create([
                'user_id' => $user->id,
                'username' => $request->username ?? NULL,
                'created_by' => $user->id,
                'status' => 1
            ]);
        }
        catch (Exception $e) {
            info('User register error: ' . $e->getMessage());
        }

        Auth::login($user);

        session()->flash('success', 'Account registration successfully.');

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
