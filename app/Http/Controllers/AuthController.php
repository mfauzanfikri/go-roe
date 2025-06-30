<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
