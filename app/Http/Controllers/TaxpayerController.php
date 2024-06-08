<?php

namespace App\Http\Controllers;

use App\Models\LTOUser;
use App\Models\Taxpayer;
use App\Models\User;
use App\Notifications\TaxpayerRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaxpayerController extends Controller
{
    public function register()
    {
        return view('Taxpayer.TaxpayerRegistration');  
    }

    public function registerPost(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'UPN' => 'required|string|max:255|unique:users,UPN',
            'dob' => 'required|date',
            'category' => 'required|string|in:Bank,Government',
            'idNo' => 'required|string|max:255|unique:users,idNo',
            'companyName' => 'required|string|max:255',
            'uen' => 'required|string|max:255',
            'select' => 'required|string|in:passport,nationalId',
            'addressLine1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postalCode' => 'required|string|max:255',
            'ePhoneNbr' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'code' => 'required|string|max:255',
            'password' => 'required|string|min:8'
            
        ]);
        

        DB::beginTransaction();
        try {
            // Hash password and create user
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = new User($validatedData);
            $user->status = 'pending'; // Set initial status to pending for approval process
            $user->save();

            DB::commit();
            return redirect()->route('taxpayerHome')->with('success', 'User registered successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Registration failed: " . $e->getMessage());
            return response()->json(['message' => 'Registration failed due to unexpected error'], 500);
        }
    }

    public function Taxpayerlogin(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Attempt to log in as a normal user using the 'web' guard
            if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->route('tp.dashboard')->with('success', 'You are now logged in!');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } catch (\Exception $e) {
            // Log the exception or display a generic error message
            Log::error('Exception occurred during authentication: ' . $e->getMessage());
            // Display a generic error message to the user
            return back()->withErrors([
                'error' => 'An unexpected error occurred. Please try again later.',
            ]);
        }
    }  
    
    public function TPLogin()
    {
        return view('Taxpayer.TaxpayerLogin'); 
    }

    public function userLogout()
    {
        Auth::logout();  // Log out the user from the 'ltouser' guard
        Session::flush();  // Flush the session to remove all data

        return redirect('/login');   // Redirect to the login page
    }

    public function TPDashboard()
    {
        return view('Taxpayer.TPDashboard'); // Assuming your Blade file is named TPDashboard.blade.php
    }

    public function taxpayerHome()
    {
        return view('Taxpayer.Home'); 
    }

    

  

}
