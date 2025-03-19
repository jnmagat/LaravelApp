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
         $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]); 

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login.form')->with('success', 'Registration successful, please login.');

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
