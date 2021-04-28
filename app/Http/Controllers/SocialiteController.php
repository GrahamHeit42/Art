<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function login($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        try {
            $userSocial = Socialite::driver($social)->stateless()->user();

            $updateData = [
                'display_name' => $userSocial->getName(),
                'username' => $userSocial->getName(),
                $social . '_id' => $userSocial->id,
                'is_admin' => 0,
                'role_id' => 2,
                'status' => 1
            ];
            $user = User::updateOrCreate(
                ['email' => $userSocial->getEmail()],
                $updateData
            );

            if ($user) {
                Auth::loginUsingId($user->id);

                return redirect('dashboard');
            }
            session()->flash('error', 'Something went wrong, PLease try again');

            return redirect('login');
        }
        catch (Exception $e) {
            // dd($e->getMessage());
            // return view('auth.register', ['errors' => $e->getMessage()->getName()]);
            session()->flash('error', 'Something went wrong, PLease try again');

            return redirect('login');
        }
    }
}
