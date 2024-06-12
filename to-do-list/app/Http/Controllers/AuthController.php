<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showSignUpForm(){
        return view('sign-up');
    }

    public function showSignInForm(){
        return view('sign-in');
    }

    public function processSignUp(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), 
        ]);

        return redirect()->route('sign-up')->with('success', 'Sign-up successful!');
    }

    public function processSignIn(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
            ])) {

            return redirect()->route('index')->with('success', 'Sign-in successful!');
        }
    
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

}
