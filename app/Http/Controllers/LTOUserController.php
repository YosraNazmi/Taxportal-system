<?php

namespace App\Http\Controllers;

use AdminNotificationForRejection;
use App\Models\Form;
use App\Models\LTOUser;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\UserRejectedNotification;
use App\Notifications\UserSecondApprovedNotification;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;

class LTOUserController extends Controller
{
    //
    public function showRegistrationForm() 
    {
        return view('LTOusers.LTOuserRegistration');
    }

    public function LTOregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:ltouser,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'role' => 'required|string|max:255',
            'gender' => 'required|string|max:255'
        ]);

        try {
            $user = LTOUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $request->role,
                'gender' => $request->gender
            ]);

            return redirect()->back()->with('success', 'User registered successfully!');
        } catch (Exception $e) {
            Log::error("Failed to register LTO User: " . $e->getMessage());  // Log the error
            return redirect()->back()->withErrors('Failed to register user due to an unexpected error.');  // Redirect back with an error message
        }
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('LTOusers.LTOuserLogin');
    }

    // Handle the login attempt
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('ltouser')->attempt($credentials, $request->filled('remember'))) {
            //$request->session()->regenerate();

            return redirect()->intended('ltouser/LTOuserDashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout function for LTOUser
    public function LTOuserLogout()
    {
        Auth::guard('ltouser')->logout();  // Log out the user from the 'ltouser' guard
        Session::flush();  // Flush the session to remove all data

        return redirect(route('ltouser.login'));  // Redirect to the login page
    }

    public function dashboard()
    {
        // Initialize the variable
        $pendingUsersCount = 0;
        $RejectedUserCount =0;
        $unpaidPaymentsCount=0;
        $allPayments =0;
        // Check the role of the authenticated LTOuser
        if (auth()->user()->role == 'Adminstative') {
            // Fetch all users with 'pending' status for admins
            $pendingUsersCount = User::where('status', 'pending')->count();
            $rejectedUsers = User::where('status', 'rejected_by_manager')->count();
        } elseif (auth()->user()->role == 'Manager') {
            // Fetch all users with 'pending_second_approval' status for managers
            $pendingUsersCount = User::where('status', 'pending_second_approval')->count();
            $rejectedUsers=0;
        }

        $unpaidPaymentsCount = Payment::where('status', 'unpaid')->count();
        $allPayments = Payment::all()->count();

        // Pass the count to the view
        return view('LTOusers.LTOuserDashboard', compact('pendingUsersCount', 'rejectedUsers', 'unpaidPaymentsCount','allPayments'));
    }

    public function reviewPendingUsers()
    {
        // Check the role of the authenticated LTOUser
        if (auth()->user()->role === 'Adminstative') {
            // Fetch all users with 'pending' status for admins
            $pendingUsers = User::where('status', 'pending')->get();
        } elseif (auth()->user()->role === 'Manager') {
            // Fetch all users with 'pending_second_approval' status for managers
            $pendingUsers = User::where('status', 'pending_second_approval')->get();
        } else {
            // Optionally handle cases where the role doesn't match expected values
            $pendingUsers = collect(); // Returns an empty collection
            return back()->withErrors('You do not have permission to view this page.');
        }

        return view('LTOusers.ReviewPendingTPs', compact('pendingUsers'));
    }

    //Show each TP by id
    public function showTP($id)
    {
        $user = User::findOrFail($id); 
        return view('LTOusers.ViewPendingTP', compact('user')); 
    }

    public function firstApprove(Request $request, User $user)
    {
       
        $request->validate([
            'approval_comment' => 'required|string|max:255',
        ]);

        // Save the comment and update the status
        $user->update([
            'status' => 'pending_second_approval',
            'approval_comment' => $request->approval_comment,
        ]);

        // Notify the LTOUser Admin
        $adminUser = LTOUser::where('role', 'Manager')->first();
        if ($adminUser) {
            $adminUser->notify(new \App\Notifications\UserSecondApprovedNotification($user, $request->approval_comment));
        }
        


        return redirect()->route('review-pending-users')->with('success', 'Taxpayer approved successfully and pending further review.');
    }


    public function secondApprove(Request $request, User $user)
    {
        $request->validate([
            'approval_type' => 'required|string|in:LTO,PIT', // Ensure a valid approval type is provided
        ]);
    
        // Assuming 'approved' is the final status after the second approval
        $user->update([
            'status' => 'approved',
            'approval_type' => $request->approval_type,
        ]);

        $approvalType = $request->approval_type;

        // Notify the user via email that their account has been approved
        $user->notify(new \App\Notifications\UserApprovedNotification($approvalType));

        return redirect()->route('review-pending-users')->with('success', 'Taxpayer approved successfully.');
    }

    public function rejectUser(Request $request, User $user)
    {
        $role = auth()->user()->role;
        
        $validated = $request->validate([
            'approval_comment' => 'required|string|max:255',
        ]);
    
        if ($role === 'Adminstative') {
            // Admin rejecting the user
            $user->update(['status' => 'rejected']);
            $user->notify(new UserRejectedNotification($validated['approval_comment']));
            return redirect()->route('review-pending-users')->with('success', 'User rejected successfully.');
        } elseif ($role === 'Manager') {
            // Manager rejecting the user, needs to notify LTOUser Admin
            $comment = $validated['approval_comment'];
            $user->update(['status' => 'rejected_by_manager', 'manager_comment' => $comment]);
            
            // Notify the LTOUser Admin
            $adminUser = LTOUser::where('role', 'Adminstative')->first();
            if ($adminUser) {
                $adminUser->notify(new \App\Notifications\AdminNotificationForRejection($user, $request->approval_comment));
            }
            
            return redirect()->route('review-pending-users')->with('success', 'Rejection noted. The admin has been notified for further assistance.');
        } else {
            // Handle unexpected role
            return back()->withErrors('Unauthorized action.');
        }
    }

    public function showRejectedUser()
    {
        // Check if the user is authenticated and has the correct role
        if (auth()->check() && auth()->user()->role === 'Adminstative') {
            // Corrected where clause
            $rejectedUsers = User::where('status', 'rejected_by_manager')->get();
        } else {
            // Return an empty collection and an error message if the user does not have permission
            $rejectedUsers = collect(); // Returns an empty collection
            return redirect()->back()->withErrors('You do not have permission to view this page.');
        }
        
        return view('LTOusers.RejectedbyLtoManager', compact('rejectedUsers'));
    }

    public function viewRejectedUsers()
    {
        // Check the role of the authenticated LTOUser
        if (auth()->user()->role === 'Adminstative') {
            // Fetch all users with 'rejected_by_manager' status for admins
            $rejectedUsers = User::where('status', 'rejected_by_manager')->get();
        } else {
            // Optionally handle cases where the role doesn't match expected values
            $rejectedUsers = collect(); // Returns an empty collection
            return back()->withErrors('You do not have permission to view this page.');
        }

        return view('LTOusers.ViewRejectedUser', compact('rejectedUsers'));
    }

    public function allTaxpayers(Request $request)
    {
        $query = User::query();

        if ($request->filled('uen')) {
            $query->where('uen', 'like', '%' . $request->input('uen') . '%');
        }

        if($request->filled('status')){
            $query->where('status', 'like', '%'. $request->input('status') . '%');
        }
        if($request->filled('approval_type')){
            $query->where('approval_type', 'like', '%'. $request->input('approval_type') . '%');
        }

        $users = $query->get();
        return view('LTOusers.AllTaxpayers', compact('users'));
    }

    public function viewOneTaxpayer($id)
    {
        $user = User::findOrFail($id); 
        return view('LTOusers.ViewOneTaxpayer', compact('user'));
    }

    public function newAdmin()
    {   
        return view('LTOusers.CreateLTOUsers');
    }

    public function allLtoUser( Request $request)
    {   
        $query = LTOUser::query();
        if($request->filled('name')){
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $users = $query->get();
        return view('LTOusers.ViewAllLTOusers', compact('users'));
    }

    public function updateLTOUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:ltouser,email,'.$id,
            'password' => 'nullable|string|min:8', // Make password nullable
            'phone' => 'required|string|max:15',
            'role' => 'required|string|max:255',
            'gender' => 'required|string|max:255'
        ]);

        try {
            // Find the user by ID
            $user = LTOUser::findOrFail($id);

            // Update the user information
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->gender = $request->gender;

            // Update the password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Save the changes
            $user->save();

            return redirect()->back()->with('success', 'User updated successfully!');
        } catch (Exception $e) {
            Log::error("Failed to update LTO User: " . $e->getMessage());  // Log the error
            return redirect()->back()->withErrors('Failed to update user due to an unexpected error.');  // Redirect back with an error message
        }
    }


    public function showUpdateForm($id)
    {
        $user = LTOUser::findOrFail($id);
        return view('LTOusers.UpdateLTOUser', compact('user'));
    }

    //charts method
    public function getTaxpayersDueTax()
    {
        // Retrieve data from the database
        $forms = Form::select('user_id', 'dueTax')->get(); // Assuming 'user_id' and 'dueTax' are the correct column names
        
        // Extract user ids and due taxes from the collection
        $taxpayers = $forms->pluck('user_id')->toArray();
        $dueTax = $forms->pluck('dueTax')->toArray();
        
        // Return the data as JSON
        return response()->json([
            'taxpayers' => $taxpayers,
            'due_tax' => $dueTax,
        ]);
    }

    public function getUserFormCount()
    {
        $users = User::withCount('forms')->get(); // Retrieve users with the count of forms they have
    
        return response()->json($users);
    }

    public function getSubmissionStatistics()
    {
        // Total number of users
        $totalUsers = User::count();

        // Number of users who have submitted at least one form
        $usersWithForms = User::whereHas('forms')->count();

        // Number of users who have not submitted any form
        $usersWithoutForms = $totalUsers - $usersWithForms;

        // Return the data as JSON
        return response()->json([
            'submitted' => $usersWithForms,
            'not_submitted' => $usersWithoutForms,
        ]);
    }

    

    
    

    

    




}
