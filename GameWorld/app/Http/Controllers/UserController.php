<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function login(request $request)
    {
        $incomingFields = $request->validate([
            'loginEmail' => 'required',
            'loginpassword' => 'required'
        ]);

        if (Auth::attempt(['email' => $incomingFields['loginEmail'], 'password' => $incomingFields['loginpassword']]))
        {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout()
    {
        auth::logout();
        return redirect('/');
    }
    
    public function register(Request $request)
    {
        // Validate form fields
        $incomingFields = $request->validate([
            'firstName'        => ['required', 'string', 'max:255'],
            'lastName'         => ['required', 'string', 'max:255'],
            'email'            => ['required', 'email', Rule::unique('users', 'email')],
            'password'         => ['required', 'confirmed'], // 'confirmed' checks password + password_confirmation
        ]);

        // Combine first + last name
        $incomingFields['name'] = $incomingFields['firstName'] . ' ' . $incomingFields['lastName'];

        // Encrypt password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Add admin field
        $incomingFields['admin'] = false;

        // Create user
        $user = User::create($incomingFields);

        // Log in
        Auth::login($user);

        return redirect('/');
    }
}