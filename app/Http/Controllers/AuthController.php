<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Reseller;

class AuthController extends Controller
{

    public function signup(Request $request) {

        $request->validate([
            'role'     => ['required', 'exists:users,role'],
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email',
            'phone'    => 'nullable|string|max:15|unique:users,phone',
            'password' => 'nullable|string|min:4|confirmed',
        ]);


        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
        ]);

        return to_route('login');


    }

    public function registrasi() {
        return view('registrasi');
    }

    public function index() {
        return view('dashboard');
    }

    public function showLoginForm() {

        if (Auth::check()) {
            return redirect()->route(auth()->user()->role . '.index');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login sebagai User (guard: web)
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();

            return match(Role::from($user->role)) {
                Role::ADMINGUDANG => redirect()->route('admingudang.index'),
                Role::ADMINTOKO => redirect()->route('admintoko.index'),
                Role::PEMILIKTOKO => redirect()->route('pemiliktoko.index'),
                Role::KURIR => redirect()->route('kurir.index'),
                default => redirect()->route('login'),
            };
        }

        // Coba login sebagai Reseller (guard: reseller)
        if (Auth::guard('reseller')->attempt($credentials)) {
            $request->session()->regenerate();
            $reseller = Auth::guard('reseller')->user();

            if ($reseller->role === Role::RESELLER->value) {
                return redirect()->route('reseller.index');
            }
        }

        flash('Email atau password salah', 'danger');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('reseller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
