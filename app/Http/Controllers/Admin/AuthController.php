<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Fungsi menampilkan halaman view formulir login
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (in_array($user->role, ['admin', 'org_admin'])) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        return view('auth.login');
    }

    // 2. Fungsi memproses validasi Submit Log In
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if (in_array($user->role, ['admin', 'org_admin'])) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang Anda berikan tidak terdaftar di rekaman kami.',
        ]);
    }

    // 3. Fungsi memproses Log Out (Keluar)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
