<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            Log::error('Google auth callback failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Gagal terhubung ke Google. Silakan coba lagi.']);
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User',
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(uniqid('google_', true)),
                'google_id' => $googleUser->getId(),
                'provider' => 'google',
                'email_verified_at' => now(),
                'role' => 'user',
            ]);
        } else {
            $user->update([
                'google_id' => $googleUser->getId(),
                'provider' => 'google',
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, true);

        $fallback = $user->role === 'admin' || $user->role === 'org_admin'
            ? route('admin.dashboard')
            : route('home');

        return redirect()->intended($fallback);
    }
}
