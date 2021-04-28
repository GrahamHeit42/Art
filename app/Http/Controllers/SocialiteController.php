<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
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
                $social . '_id' => $userSocial->id,
                'display_name' => $userSocial->getName(),
                'username' => Str::replaceFirst(' ', '-', Str::lower($userSocial->getName())),
                'status' => 1
            ];
            $user = User::updateOrCreate(
                ['email' => $userSocial->getEmail()],
                $updateData
            );

            if ($user) {
                Auth::loginUsingId($user->id);

                return redirect(url('/'));
            }
            session()->flash('error', 'Something went wrong, PLease try again');

            return redirect(route('login'));
        }
        catch (\Exception $e) {
            session()->flash('error', 'Something went wrong, PLease try again');

            return redirect(route('login'));
        }
    }
}
