<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function RetrivePaymentt(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();
    
        // Retrieve all forms with their associated payments for the user
        $query = $user->forms()->with('payment');
    
        // Apply form reference filter if provided
        $formReference = $request->query('form_reference');
        if ($formReference) {
            $query->whereHas('payment', function ($q) use ($formReference) {
                $q->where('form_reference', 'like', '%' . $formReference . '%');
            });
        }
    
        $formsWithPayments = $query->get();
    
        return view('Taxpayer.ViewDuePayments', compact('formsWithPayments'));
    }

    public function showPayment($id)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Retrieve the payment along with its associated form if it belongs to the authenticated user
        $payment = Payment::whereHas('form', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('form')->findOrFail($id);

        // Return the view with the payment and form details
        return view('Taxpayer.ViewOneDuePayment', compact('payment'));
    }

    public function viewAllPayment(Request $request)
    {
        $formReference = $request->input('form_reference');

        // Query payments
        $paymentsQuery = Payment::query();

        if ($formReference) {
            $paymentsQuery->where('form_reference', $formReference);
        }

        $payments = $paymentsQuery->get();
     
        return view('LTOusers.AllPayments', compact('payments'));
    }

    //LTO
    public function showOnePayment($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return redirect()->back()->with('error', 'Payment not found.');
        }

        return view('LTOusers.ViewOnePayment', compact('payment'));
    }

    public function showUnpaidPayments(Request $request)
    {
        // Retrieve the form reference filter value from the request
        $formReferenceFilter = $request->input('form_reference');

        // Query payments with unpaid status
        $query = Payment::where('status', 'unpaid');

        // Apply the form reference filter if provided
        if ($formReferenceFilter) {
            $query->where('form_reference', $formReferenceFilter);
        }

        // Fetch the unpaid payments
        $unpaidPayments = $query->get();

        // Pass the unpaid payments to the view along with the form reference filter value
        return view('LTOusers.ViewPendingPayments', compact('unpaidPayments', 'formReferenceFilter'));
    }


}


