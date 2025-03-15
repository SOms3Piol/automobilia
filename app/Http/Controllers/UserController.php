<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users,name', // Assuming 'name' replaces 'username'
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required', // Ensure confirmation is provided
        ], [
            'name.required' => 'Name is required',
            'name.unique' => 'This name is already taken.',
            'name.max' => 'Name cannot be longer than 255 characters.',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Passwords do not match.',
            'password_confirmation.required' => 'Please confirm your password.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'), // Mutator hashes it
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function login(Request $request){
        
        $data = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
    
       
        if(Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ])){
            return redirect()->route('home');  
        }
        else {
            return redirect()->route('login')  
                   ->withErrors(['login' => 'Invalid Email or Password!']);
        }
    }
    public function logout(Request $request){
        Auth::logout();
       return redirect()->route('home');
    }
    
}
