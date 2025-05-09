<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            $request->session()->regenerate();

            return match(Role::from($user->role)) {
                 Role::ADMINGUDANG => redirect()->route('admingudang.index'),
                 Role::ADMINTOKO => redirect()->route('admintoko.index'),
                 Role::RESELLER => redirect()->route('reseller.index'),
                 Role::PEMILIKTOKO => redirect()->route('pemiliktoko.index'),
                 Role::KURIR => redirect()->route('kurir.index'),
                default => redirect()->route('login')
            };

        }

        flash('Password atau email salah', 'danger');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
