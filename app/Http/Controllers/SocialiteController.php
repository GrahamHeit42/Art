<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    /**
     * Handle Social login request
     *
     * @return response
     */
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }
    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Response
     */
    public function handleProviderCallback($social)
    {
        try {
            $userSocial = Socialite::driver($social)->stateless()->user();

            $updateData = [
                'first_name' => $userSocial->getName(),
                'last_name' => $userSocial->getName(),
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
        } catch (Exception $e) {
            // dd($e->getMessage());
            // return view('auth.register', ['errors' => $e->getMessage()->getName()]);
            session()->flash('error', 'Something went wrong, PLease try again');
            return redirect('login');
        }
    }
}
