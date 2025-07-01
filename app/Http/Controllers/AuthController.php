<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function back;
use function redirect;
use function view;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            'title' => 'Login'
        ]);
    }

    public function showRegistrationForm()
    {
        return view('pages.auth.register', [
            'title' => 'Register'
        ]);
    }

    public function showTutorRegistrationForm()
    {
        return view('pages.auth.tutor-register', [
            'title' => 'Register'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request)
    {

    }

    public function tutorRegister(Request $request)
    {

    }
}
