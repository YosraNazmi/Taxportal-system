<?php

namespace App\Http\Controllers;

use App\Exports\UsersFormsPaymentsExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //

    public function getAllUserFormPayments(Request $request)
    {
        // Retrieve filters from the request
        $formReference = $request->input('form_reference');
        $taxpayer = $request->input('taxpayer');
        $seasonToDate = $request->input('season_to_date');
        $status = $request->input('status');
        $uen = $request->input('uen');
    
        // Build the query to retrieve users with their forms and associated payments
        $query = User::with(['forms.payment']);
    
        // Apply filters if they are present
        if ($formReference) {
            $query->whereHas('forms', function($formQuery) use ($formReference) {
                $formQuery->where('form_reference', 'like', '%' . $formReference . '%');
            });
        }
    
    
        if ($taxpayer) {
            $query->whereHas('forms', function($formQuery) use ($taxpayer) {
                $formQuery->where('taxpayer', 'like', '%' . $taxpayer . '%');
            });
        }
    
        if ($seasonToDate) {
            $query->whereHas('forms', function($formQuery) use ($seasonToDate) {
                $formQuery->where('seasontoDate', $seasonToDate);
            });
        }
    
        if ($status) {
            $query->whereHas('forms.payment', function($paymentQuery) use ($status) {
                $paymentQuery->where('status', $status);
            });
        }

        // Add the following code block for the 'uen' filter
        if ($uen) {
            $query->whereHas('forms', function($formQuery) use ($uen) {
                $formQuery->where('uen', 'like', '%' . $uen . '%');
            });
        }
        
        // Execute the query to get the filtered results
        $users = $query->get();
    
        // Return the view with the filtered users
        return view('LTOusers.PITReport', compact('users'));
    }


    public function export(Request $request)
    {
        $filters = $request->only(['form_reference', 'taxpayer', 'seasontoDate', 'status']);
        return Excel::download(new UsersFormsPaymentsExport($filters), 'users_forms_payments.xlsx');
    }

    public function CategoryReport()
    {
        // Run the SQL query to get the number of users per category
        $categories = DB::table('users')
                        ->select('category', DB::raw('count(*) as user_count'))
                        ->groupBy('category')
                        ->get();

        // Pass the data to the view
        return view('LTOusers.CategoryReport', compact('categories'));
    }
    public function QuarterReport()
    {
        // Run the SQL query to get the number of forms and users per quarter
        $quarters = DB::table('forms')
                      ->select('quarter', DB::raw('COUNT(*) as form_count'), DB::raw('COUNT(DISTINCT user_id) as user_count'))
                      ->groupBy('quarter')
                      ->get();

        // Pass the data to the view
        return view('LTOusers.QuarterReport', compact('quarters'));
    }

    public function paymentReport()
    {
        // Run the SQL query to get the user and payment status
        $payments = DB::table('forms')
                      ->leftJoin('payments', 'forms.form_reference', '=', 'payments.form_reference')
                      ->select('forms.user_id', 'forms.form_reference', 'forms.quarter', 'payments.status')
                      ->get();

        // Pass the data to the view
        return view('LTOusers.PaymentReport', compact('payments'));
    }

    public function usersWithoutForms()
    {
        // Run the SQL query to get users who have not submitted any form
        $usersWithoutForms = DB::table('users')
                                ->leftJoin('forms', 'users.id', '=', 'forms.user_id')
                                ->whereNull('forms.user_id')
                                ->select('users.id', 'users.firstname', 'users.lastname')
                                ->get();

        // Pass the data to the view
        return view('LTOusers.UsersWithoutForms', compact('usersWithoutForms'));
    }

    public function usersWithForms()
    {
        // Run the SQL query to get users who have submitted at least one form
        $usersWithForms = DB::table('users')
                            ->join('forms', 'users.id', '=', 'forms.user_id')
                            ->select('users.id', 'users.firstname', 'users.lastname')
                            ->distinct()
                            ->get();

        // Pass the data to the view
        return view('LTOusers.UsersWithForms', compact('usersWithForms'));
    }

    public function showCustomReportForm()
    {
        return view('LTOusers.CustomReport');
    }

    public function generateCustomReport(Request $request)
    {
        $field1 = $request->input('field1');
        $field2 = $request->input('field2');

        if (empty($field1) || empty($field2)) {
            return redirect()->back()->with('error', 'Please select both fields.');
        }

        // Fetch data based on selected fields
        $results = DB::table('users')
            ->leftJoin('forms', 'users.id', '=', 'forms.user_id')
            ->leftJoin('payments', 'forms.id', '=', 'payments.form_id')
            ->select($field1, $field2)
            ->get();
        // Pass selected fields and results to the view
        return view('LTOusers.CustomReport', [
            'field1' => $field1,
            'field2' => $field2,
            'results' => $results
        ]);
    }
    
    
}
