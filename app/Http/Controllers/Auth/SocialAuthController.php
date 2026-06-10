<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name'     => $googleUser->name,
                    'email'    => $googleUser->email,
                    'avatar'   => $googleUser->avatar,
                    'provider' => 'google',
                    'password' => bcrypt(\Illuminate\Support\Str::random(24)),
                ]
            );

            if (!$user->hasAnyRole(['admin', 'vendor', 'user'])) {
                $user->assignRole('user');
            }

            Auth::login($user);

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home')->with('success', 'Logged in with Google successfully!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
        }
    }
}
