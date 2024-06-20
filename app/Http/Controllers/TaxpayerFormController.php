<?php

namespace App\Http\Controllers;

use App\Exports\FormsExport;
use App\Exports\TaxFormExport;
use App\Models\Form;
use App\Models\Payment;
use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Str;

class TaxpayerFormController extends Controller
{
    //Taxpayer create PIT form
    public function NewFormPost(Request $request)
    {
        try {
            Log::info('I am here');
            $request->validate([
            'taxpayer' => 'required',
            'propertyyearfrom' => 'required',
            'propertuyearto' => 'required',
            'uen' => 'required',
            'quarter' => 'required', 
            'seasonfromDate' => 'required',
            'seasontoDate' => 'required',
            'representativename' => 'required_if:repType,yes', // Make this field required only if repType is 'yes'
            'upn' => 'required_if:repType,yes', // Make this field required only if repType is 'yes'
            'position' => 'required_if:repType,yes', // Make this field required only if repType is 'yes'
            'phone' => 'required_if:repType,yes',
            'numberofEmployee' => 'required',
            'salaryandwages' => 'required',
            'Allowancess' => 'required',
            'bonus' => 'required',
            'total' => 'required',
            'retire' => 'required',
            'Gallowances' => 'required',
            'summary' => 'required',
            'examptions' => 'required',
            'taxAmount' => 'required',
            'dueTax' => 'required',
            'delayone' => 'required',
            'dalaytwo' => 'required',
            'dalaythree' => 'required',
            'totaloftaxpen' => 'required',
            'delayinterest' => 'required',
            'paidamount' => 'required',
            'blanace' => 'required',
            'remainingbalance' => 'required',
            'tobepaid' => 'required',
            'agreeCheckbox' => 'accepted',
            ]);

            $data = $request->only([
                'taxpayer','propertyyearfrom','propertuyearto',
                'uen','quarter','seasonfromDate','seasontoDate','representativename',
                'upn','position','phone','numberofEmployee','salaryandwages','Allowancess',
                'bonus','total','retire','Gallowances','summary','examptions','taxAmount',
                'dueTax','delayone','dalaytwo','dalaythree','totaloftaxpen','delayinterest',
                'paidamount','blanace','remainingbalance','tobepaid','agreeCheckbox',
            ]);

            

            $data['user_id'] = Auth::id();
            $data['form_reference'] = $this->generateUniqueReference();

            // Calculations
            $total = floatval($request->input('salaryandwages')) + floatval($request->input('Allowancess')) + floatval($request->input('bonus'));
            $data['total'] = $total;

            $summary = floatval($request->input('total')) - floatval($request->input('retire')) - floatval($request->input('Gallowances'));
            $data['summary'] =$summary;

            $taxAmount = floatval($request->input('summary')) - floatval($request->input('examptions')) ;
            $data['taxAmount'] = $taxAmount;

            $totaloftaxpenenalty = floatval($request->input('dueTax'))+ floatval($request->input('delayone')) + floatval($request->input('dalaytwo')) + floatval($request->input('dalaythree'));
            $data['totaloftaxpen'] = $totaloftaxpenenalty;

            $paidamount = floatval($request->input('totaloftaxpen')) + floatval($request->input('delayinterest')) ;
            $data['paidamount'] = $paidamount;

            //$tobepaid = floatval($request->input('paidamount')) - floatval($request->input('blanace')) - floatval($request->input('remainingbalance'));
            //$data['tobepaid'] = $tobepaid;
            $agreeCheckbox = filter_var($request->input('agreeCheckbox'), FILTER_VALIDATE_BOOLEAN);
            $data['agreeCheckbox'] = $agreeCheckbox;
            
            // Check if the user has already applied for the selected quarter
            $existingForm = Form::where('user_id', Auth::id())
            ->where('quarter', $request->input('quarter'))
            ->first();

            if ($existingForm) {
            // User has already applied for this quarter
            return redirect()->back()->withErrors(['quarter' => 'You have already submitted a form for the selected quarter.']);

            }

            // Create new Form record
            $form = Form::create($data);

            // Create new payment record
            $payment = new Payment();
            $payment->form_id = $form->id;
            $payment->form_reference= $form->form_reference;
            $payment->dueTax= $form->paidamount;
            $payment->submission_date = now();
            // Set the payment deadline to one month after submission date
            $payment->payment_deadline = now()->addMonth();
             // Save the payment record
            $payment->save();

            

            // Validate and process the form data
            $formReferenceNumber = $form->form_reference;
            $dateOfSubmission = now()->toDateString();
            // Create the PDF with the necessary details
            $pdf = FacadePdf::loadView('pdf.form', ['form' => $form]);

            return redirect()->route('applyPIT')->with([
                'success' => true,
                'formId' => $form->id,
                'paymentId' => $payment->id,
                'formReferenceNumber' => $formReferenceNumber,
                'dateOfSubmission' => $dateOfSubmission,
                
            ]);
                    // return redirect()->route('payment', ['reference' => $form->form_reference])->with("success", "Form submitted successfully. Proceed to payment.");
            } catch (\Exception $e) {
            // Log the error for debugging
            Log::error($e);

            // Return an error message to the user
            return redirect()->route('applyPIT')->with("error", "Form submission failed. Please try again.");
            }
    }

     // Generate new Reference for each PIT form
    private function generateUniqueReference()
    {
         return 'FR-' . strtoupper(uniqid());
    }


    public function downloadPDF($formId)
    {
        // Retrieve the form data based on the form ID
        $form = Form::findOrFail($formId);

        // Generate HTML content for the PDF using the form data
        $htmlContent = view('pdf.form', ['form' => $form])->render();

        // Instantiate Dompdf and load HTML content
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlContent);

        // Render the PDF
        $dompdf->render();

        // Return PDF as a response for download
        return Response::make($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="form.pdf"'
        ]);
    }

    public function checkQuarterAvailability(Request $request)
    {
        $user_id = Auth::id();
        $quarter = $request->input('quarter');

        $existingForm = Form::where('user_id', $user_id)
                            ->where('quarter', $quarter)
                            ->exists();

        return response()->json(['exists' => $existingForm]);
    }

    public function autoSave(Request $request)
    {
        // Assuming you have a model called FormData and a method to save data
        // You might need to adapt this part according to your specific requirements

        $formData = Form::updateOrCreate(
            ['user_id' => Auth::id()], // Unique identifier for the form, e.g., user_id
            $request->all()
        );

        return response()->json(['success' => true]);
    }

    
    public function payment($reference)
    {
        return view('Taxpayer.Payment', compact('reference'));
    }
 
    public function applyPIT()
    {
        return view('Taxpayer.ApplyForPIT');
    }

    public function GeneralTax(Request $request)
    { 
        
        $user = auth()->user(); // Get the logged-in user

        $query = $user->forms(); 
      //  dd($query->toSql());
        if ($request->filled('form_reference')) {
            $query->where('form_reference', 'like', '%' . $request->input('form_reference') . '%');
        }
        $forms = $query->paginate(8); 
       
        return view('Taxpayer.GeneralTaxpayer', compact('forms'));
    }
    
    public function ViewForm($id)
    {
        $form = Form::findOrFail($id); // Find the form by ID or fail
        return view('Taxpayer.ViewForm', compact('form')); // Pass the form data to the view
    }

    public function downloadFormPdf($id)
    {   
            // Check if $id is an integer
        if (!is_numeric($id)) {
            abort(404); // Return a 404 error if the id is not numeric
        }

        // Retrieve the form data by ID
        $form = Form::findOrFail((int)$id);

        // Load the form view
        
        // Load the form view and pass the form data to it
        $pdf = FacadePdf::loadView('pdf.ViewPITFormPdf', compact('form'));

        // Set paper size and orientation (optional)
        $pdf->setPaper('A4', 'portrait');

        // Download the PDF
        return $pdf->download('tax_form.pdf');
    }

    public function ViewAllPITForms(Request $request)
    {
        // Get the tax_reference from the request
        $tax_reference = $request->input('form_reference');

        // Filter forms based on tax_reference if provided
        if ($tax_reference) {
            $forms = Form::where('form_reference', $tax_reference)->get();
        } else {
            $forms = Form::all();
        }

        return view('LTOUsers.ViewAllPITForms', compact('forms'));
    }
    
    public function ViewOnePitForm($id)
    {
        $form = Form::findOrFail($id); // Find the form by ID or fail
        return view('LTOusers.ViewOnePITForm', compact('form')); // Pass the form data to the view
    }

    public function exportToExcel()
    {
        return Excel::download(new TaxFormExport, 'user_forms.xlsx');
    }

    public function generateReport(Request $request)
    {
        // Retrieve forms with payments for the logged-in user
        $query = Auth::user()->forms()->with('payment');
        
        // Apply tax reference filter if provided
        $formReference = $request->query('form_reference');
        if ($formReference) {
            $query->where('form_reference', 'like', '%' . $formReference . '%');
        }
        
        $formsWithPayments = $query->get();
        
        // Calculate total due tax amount
        $totalDueTax = $formsWithPayments->sum(function ($form) {
            return $form->payment ? $form->payment->dueTax : 0;
        });
        
        // Check if the user wants to export to Excel
        if ($request->has('export') && $request->get('export') == 'excel') {
            return Excel::download(new FormsExport($formsWithPayments, $totalDueTax), 'Annual_forms_report.xlsx');
        }
        
        return view('Taxpayer.Generatereport', [
            'formsWithPayments' => $formsWithPayments,
            'totalDueTax' => $totalDueTax,
        ]);
    }
    

   

}
