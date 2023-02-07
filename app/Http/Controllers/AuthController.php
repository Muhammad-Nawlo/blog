<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
        ]);

        $user = User::create($attributes);
        auth()->login($user);
        return redirect('/')->with('success', 'Your account has been created');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function signIn()
    {
        $credentials = request()->validate([
            'email' => ["required", "email", Rule::exists('users', 'email')],
            'password' => 'required|min:8|max:255',
        ]);
        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect('/')->with('success', 'You are logged in');
        }
        return back()->withInput(['email'])->withErrors(['email' => 'Your credentials are not valid']);

    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You are logged out');
    }
}
