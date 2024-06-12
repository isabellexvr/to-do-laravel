<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showSignUpForm()
    {
        return view('sign-up');
    }

    public function processSignUp(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Process the sign-up logic, e.g., create the user in the database
        // ...

        return redirect()->route('sign-up')->with('success', 'Sign-up successful!');
    }

}
