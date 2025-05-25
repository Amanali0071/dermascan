<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            
            // Find existing user or create new one
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if (!$user) {
                // Create new user
                $user = User::create([
                    'first_name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(rand(1, 10000)),
                    'type' => User::PATIENT,
                    'email_verified_at' => now(),
                    'language' => getSettingValue('language'),
                    $provider.'_id' => $socialUser->getId(),
                ]);
            } else {
                // Update provider ID if not set
                if (empty($user->{$provider.'_id'})) {
                    $user->{$provider.'_id'} = $socialUser->getId();
                    $user->save();
                }
            }
            
            // Login user
            Auth::login($user);
            
            return redirect()->intended(getDashboardURL());
            
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Authentication failed. Please try again.');
        }
    }
}