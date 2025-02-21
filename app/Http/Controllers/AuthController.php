<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function index() {
        return view('dashboard');
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            $request->session()->regenerate();

            return match($user->role) {
                'admin_gudang' => redirect()->route('admingudang.index'),
                'admin_toko' => redirect()->route('admintoko.index'),
                'reseller' => redirect()->route('reseller.index'),
                'pemilik_toko' => redirect()->route('pemiliktoko.index'),
                'kurir' => redirect()->route('kurir.index'),
                default => redirect()->route('login')
            };

        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
