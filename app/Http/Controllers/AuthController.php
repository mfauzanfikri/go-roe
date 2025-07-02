<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'grade' => 'required|in:SD,SMP,SMA',
            'address' => 'required|string|max:500',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        Student::create([
            'user_id' => $user->id,
            'grade' => $request->grade,
            'address' => $request->address,
        ]);

        // Optionally login
        auth()->login($user);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil sebagai murid.');
    }

    public function tutorRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'grade' => 'required|in:SD,SMP,SMA',
            'subject' => 'required|string|max:100',
            'address' => 'required|string|max:500',
            'description' => 'required|string|max:500',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'available_days' => 'required|array|min:1', // ['Senin', 'Rabu'] via multiple select
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        Tutor::create([
            'user_id' => $user->id,
            'grade' => $request->grade,
            'subject' => $request->subject,
            'description' => $request->description,
            'address' => $request->address,
            'available_days' => $request->available_days,
        ]);

        auth()->login($user);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil sebagai tutor.');
    }
}
