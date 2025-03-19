<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private function redirectIfAuthenticated($view) {
        return session()->has('user_id') ? redirect()->route('dashboard') : view($view);
    }

    public function showLoginForm() {
        return $this->redirectIfAuthenticated('auth.login');
    }
    
    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->id);
            return redirect()->route('dashboard');
        }
            return back()->with('error', 'Invalid Credentials');
    }


    public function showRegisterForm() {
        return $this->redirectIfAuthenticated('auth.register');
    }

    public function register(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('login.form')->with('success', 'Registration successful! Please log in.');
    }


    public function dashboard() {
        return view('dashboard');
    }

    public function logout(Request $request) {
        Session::flush();
        $request->session()->forget('user_id');
        return redirect()->route('login.form')->with('success', 'You have been logged out.');
    }
}
