<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RepresnetativeController extends Controller
{
    //
    public function representative(){
       return view('Taxpayer.AddRepresentative');
    }

    public function store(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to create a representative.');
        }

        $userId = Auth::user();
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|unique:representatives|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

    

        try {
            // Create a new Representative instance with user_id set to authenticated user's ID
            $representative = new Representative([
                'user_id' => $userId->id ,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Encrypt the password
            ]);
            $representative->save();
        

            // Redirect back with success message
            return redirect('/viewRepresentatives')->with('success', 'Representative created successfully!');

        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return redirect()->back()->with('error', 'Failed to create representative. Please try again.');
        }
    }

    public function showRepresentative()
    {
        $representative = Representative::all();
        return view('Taxpayer.RepresentativeUsers', compact('representative'));
    }

    public function edit($id)
    {
        $representative = Representative::findOrFail($id); // Retrieve the representative by ID
        return view('Taxpayer.UpdateRepresentative', compact('representative')); // Pass the representative data to the view
    }

    public function update(Request $request, $id)
    {
        $representative = Representative::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:representatives,email,'.$id,
            'password' => 'nullable|string|min:8|max:255', // Password is optional for update
        ]);
    
        $representative->name = $request->name;
        $representative->email = $request->email;
        $representative->phone = $request->phone;
        $representative->status =$request->status;
    
        // Update the password if provided
        if ($request->filled('password')) {
            $representative->password = Hash::make($request->password);
        }
    
        try {
            $representative->save(); // Update the representative with the new data
            return redirect()->back()->with('success', 'Representative updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update representative. Please try again.');
        }
    }

    
}