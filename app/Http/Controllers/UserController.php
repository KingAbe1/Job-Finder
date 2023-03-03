<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        $fromFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        //Hash password
        $fromFields['password'] = bcrypt($fromFields['password']);

        $user = User::create($fromFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in successfully');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have logged out successfully');
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $fromFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($fromFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message','You have successfully logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentails'])->onlyInput('email');
    }
}
