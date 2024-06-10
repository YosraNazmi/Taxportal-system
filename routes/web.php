<?php

use App\Http\Controllers\AnnualTaxController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LTOUserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RepresnetativeController;
use App\Http\Controllers\TaxpayerController;
use App\Http\Controllers\TaxpayerFormController;
use App\Models\Form;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

// Welcome route
Route::get('/', function () {
    return view('welcome');
});

Route::get('/design', function () {
    return view('design');
});


// Taxpayer routes
Route::controller(TaxpayerController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerPost')->name('register.post');
    Route::get('/login', 'TPLogin')->name('login');
    Route::post('/login', 'Taxpayerlogin')->name('login.post');
    Route::get('/taxpayer/home', 'taxpayerHome')->name('taxpayerHome');
    Route::get('/logout', 'userLogout')->name('userLogout');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/taxpayer/dashboard', [TaxpayerController::class, 'TPDashboard'])->name('tp.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/taxpayer/general',[TaxpayerFormController::class, 'GeneralTax'])->name('GeneralTax');
    Route::post('/taxpayer/NewForm', [TaxpayerFormController::class, 'NewFormPost'])->name('NewForm.Post');
    Route::get('/taxpayer/applyPIT', [TaxpayerFormController::class, 'applyPIT'])->name('applyPIT');
    Route::get('/taxpayer/payment/{reference}', [TaxpayerFormController::class, 'payment'])->name('payment');
    Route::get('/taxpayer/ViewForms',  [TaxpayerFormController::class, 'showData'])->name('ViewForms');
    Route::get('/taxpayer/filter-forms', [TaxpayerFormController::class, 'showData'])->name('filterForms');
    Route::get('/taxpayer/viewform/{id}', [TaxpayerFormController::class, 'ViewForm'])->name('ViewForm');
    Route::get('/download-form-pdf/{id}', [TaxpayerFormController::class, 'downloadFormPdf'])->name('download.form.pdf')->where('id', '[0-9]+');
    Route::get('/taxpayer/payments', [PaymentController::class, 'RetrivePaymentt'])->name('RetrivePaymentt');
    Route::get('/taxpayer/payments/{id}', [PaymentController::class, 'showPayment'])->name('paymentshow');
    Route::get('/download-pdf/{formId}', [TaxpayerFormController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('/export-tax-form', [TaxpayerFormController::class, 'exportToExcel'])->name('exportToExcel');
    Route::post('/form/autosave', [TaxpayerFormController::class, 'autoSave'])->name('NewForm.AutoSave');
    Route::post('/check-quarter-availability', [TaxpayerFormController::class, 'checkQuarterAvailability'])->name('checkQuarterAvailability');
    Route::post('/form/autosave', [TaxpayerFormController::class, 'autoSave'])->name('form.autosave');
    Route::post('/representatives', [RepresnetativeController::class, 'store'])->name('representative.store');
    Route::get('/representatives', [RepresnetativeController::class, 'representative']);
    Route::get('/viewRepresentatives', [RepresnetativeController::class, 'showRepresentative'])->name('showRepresentative');
    Route::get('/representatives/{id}/edit', [RepresnetativeController::class, 'edit'])->name('representative.edit');
    Route::put('/representatives/{id}', [RepresnetativeController::class, 'update'])->name('representative.update');
    Route::get('/generate-report', [TaxpayerFormController::class, 'generateReport'])->name('generateReport');

    Route::get('/income_tax_declaration', [AnnualTaxController::class, 'formA'])->name('formA');
    Route::post('/income_tax_declaration', [AnnualTaxController::class, 'submitFormA'])->name('submitFormA');


    Route::get('/appendix-one', [AnnualTaxController::class, 'appendixOne'])->name('appendixOne');
    Route::post('/appendix-one', [AnnualTaxController::class, 'storeAppendixOne'])->name('appendixOne.store');

    Route::get('/appendix-two', [AnnualTaxController::class, 'appendixTwo'])->name('appendixTwo');
    Route::post('/appendix-two', [AnnualTaxController::class, 'storeAppendixTwo'])->name('appendixTwo.store');

    Route::get('/form-c',[AnnualTaxController::class, 'formC'])->name('formC');
    Route::get('/AppendixThree',[AnnualTaxController::class, 'formF'])->name('formF');
    Route::get('/appendix/{number}', [AnnualTaxController::class, 'Appendix'])->name('appendix.show');

    Route::post('/store_AppendixThree', [AnnualTaxController::class, 'storeAppendixThree'])->name('AppendixThree.store');
    Route::post('/store_AppendixFour', [AnnualTaxController::class, 'storeAppendixFour'])->name('AppendixFour.store');
    Route::post('/store_AppendixFive', [AnnualTaxController::class, 'storeAppendixFive'])->name('AppendixFive.store');
    Route::post('/store_AppendixSix', [AnnualTaxController::class, 'storeAppendixSix'])->name('AppendixSix.store');
    Route::post('/store_AppendixSeven', [AnnualTaxController::class, 'storeAppendixSeven'])->name('AppendixSeven.store');
    Route::post('/store_AppendixEight', [AnnualTaxController::class, 'storeAppendixEight'])->name('AppendixEight.store');
    Route::post('/store_AppendixNine', [AnnualTaxController::class, 'storeAppendixNine'])->name('AppendixNine.store');
    Route::post('/store_AppendixTen', [AnnualTaxController::class, 'storeAppendixTen'])->name('AppendixTen.store');
    Route::post('/store_AppendixEleven', [AnnualTaxController::class, 'storeAppendixEleven'])->name('AppendixEleven.store');
    Route::post('/store_AppendixTwelve', [AnnualTaxController::class, 'storeAppendixTwelve'])->name('AppendixTwelve.store');
    Route::post('/store_AppendixThirteen', [AnnualTaxController::class, 'storeAppendixThirteen'])->name('AppendixThirteen.store');
    Route::post('/store_AppendixFourteen', [AnnualTaxController::class, 'storeAppendixFourteen'])->name('AppendixFourteen.store');
    Route::post('/store_AppendixFifteen', [AnnualTaxController::class, 'storeAppendixFifteen'])->name('AppendixFifteen.store');
    Route::post('/store_AppendixSixteen', [AnnualTaxController::class, 'storeAppendixSixteen'])->name('AppendixSixteen.store');
    Route::post('/store_AppendixSeventeen', [AnnualTaxController::class, 'storeAppendixSeventeen'])->name('AppendixSeventeen.store');
    Route::post('/store_AppendixEighteen', [AnnualTaxController::class, 'storeAppendixEighteen'])->name('AppendixEighteen.store');
    Route::post('/store_AppendixNineteen', [AnnualTaxController::class, 'storeAppendixNineteen'])->name('AppendixNineteen.store');
    Route::post('/store_AppendixTwenty', [AnnualTaxController::class, 'storeAppendixTwenty'])->name('AppendixTwenty.store');
    Route::post('/store_AppendixTwentyOne', [AnnualTaxController::class, 'storeAppendixTwentyOne'])->name('AppendixTwentyOne.store');
    Route::post('/store_AppendixTwentyTwo', [AnnualTaxController::class, 'storeAppendixTwentyTwo'])->name('AppendixTwentyTwo.store');
    Route::post('/store_AppendixTwentyThree', [AnnualTaxController::class, 'storeAppendixTwentyThree'])->name('AppendixTwentyThree.store');
    Route::post('/store_AppendixTwentyFour', [AnnualTaxController::class, 'storeAppendixTwentyFour'])->name('AppendixTwentyFour.store');
    Route::post('/store_AppendixTwentyFive', [AnnualTaxController::class, 'storeAppendixTwentyFive'])->name('AppendixTwentyFive.store');
    Route::post('/store_AppendixTwentySix', [AnnualTaxController::class, 'storeAppendixTwentySix'])->name('AppendixTwentySix.store');
    Route::post('/store_AppendixTwentySeven', [AnnualTaxController::class, 'storeAppendixTwentySeven'])->name('AppendixTwentySeven.store');
}); 


// LTOUser routes
Route::middleware(['auth:ltouser'])->controller(LTOUserController::class)->group(function () {
    Route::get('/ltouser/LTOuserDashboard', 'dashboard')->name('ltouser.dashboard');
    Route::get('/ltouser/review-pending-users', 'reviewPendingUsers')->name('review-pending-users');
    Route::get('/ltouser/user/{id}', 'showTP')->name('showTP');
    Route::post('/users/{user}/first-approve', 'firstApprove')->name('admin.firstApprove');
    Route::post('/users/{user}/second-approve', 'secondApprove')->name('admin.secondApprove');
    Route::post('/users/{user}/reject', 'rejectUser')->name('admin.rejectUser');
    Route::get('/user/rejected','showRejectedUser')->name('rejected.user');
    Route::get('/ltouser/ViewRejected', 'viewRejectedUsers')->name('rejectedUser');
    Route::get('/ltouser/allTaxpayers', 'allTaxpayers')->name('allTaxpayers');
    Route::get('/ltouser/allTaxpayers/taxpayer/{id}', 'viewOneTaxpayer')->name('viewOneTaxpayer');
    Route::get('/ltouser/newAdmin', 'newAdmin')->name('NewAdmin');
    Route::get('/ltouser/allLtoUser', 'allLtoUser')->name('allLtoUser');
    Route::post('/ltouser/allLtoUserUpdate/{id}', 'updateLTOUser')->name('updateLTOUser');
    Route::get('/ltouser/allLtoUserUpdate/{id}', 'showUpdateForm')->name('showUpdateForm');
    
});

Route::middleware(['auth:ltouser'])->group(function () {
    Route::get('/ltouser/viewAllPitForms', [TaxpayerFormController::class, 'ViewAllPITForms'])->name('viewAllPitForms');
    Route::get('/ltouser/allTaxpayers/PITForm/{id}',[TaxpayerFormController::class, 'ViewOnePitForm'])->name('ViewOnePitForm');
    Route::get('/ltouser/viewAllPayment',[PaymentController::class, 'viewAllPayment'])->name('viewAllPayment');
    Route::get('/ltouser/PitFormReport', [ReportController::class, 'getAllUserFormPayments'])->name('PitFormReport');
    Route::get('/ltouser/export', [ReportController::class, 'export'])->name('export');
    Route::get('/dynamic-chart', [ChartController::class, 'index'])->name('dynamic-chart');
    Route::post('/dynamic-chart-data', [ChartController::class, 'chartData'])->name('chart.data'); 
    Route::get('/download-pdf/{formId}', [TaxpayerFormController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('/ltouser/payments/unpaid', [PaymentController::class, 'showUnpaidPayments'])->name('showUnpaidPayments');
    Route::post('/ltouser/get-season-dates', [TaxpayerFormController::class,'getSeasonDates'])->name('get-season-dates');
    Route::get('/ltouser/payments/{id}', [PaymentController::class, 'showOnePayment'])->name('payments.show');

    Route::get('/dashboard/taxpayers-due-tax', [LTOUserController::class, 'getTaxpayersDueTax']);
    Route::get('/dashboard/user-form-count', [LTOUserController::class, 'getUserFormCount']);
    Route::get('/dashboard/submission-statistics', [LTOUserController::class, 'getSubmissionStatistics']);
    Route::get('/export-chart-data', [ChartController::class, 'exportChartData'])->name('exportChartData');

    Route::get('/ltouser/category-report', [ReportController::class, 'CategoryReport'])->name('CategoryReport');
    Route::get('/ltouser/quarter-report', [ReportController::class, 'QuarterReport'])->name('QuarterReport');
    Route::get('/ltouser/payment-report', [ReportController::class, 'paymentReport'])->name('paymentReport');
    Route::get('ltouser/users-without-forms', [ReportController::class, 'usersWithoutForms'])->name('usersWithoutForms');
    Route::get('ltouser/users-with-forms', [ReportController::class, 'usersWithForms'])->name('usersWithForms');
    Route::get('ltouser/custom-report', [ReportController::class, 'showCustomReportForm'])->name('show.custom.report.form');
    Route::post('ltouser/generate-custom-report', [ReportController::class, 'generateCustomReport'])->name('generate.custom.report');
});


// Separate registration/login routes for LTOUser, no need to be under auth middleware
Route::get('/ltouser/login',[LTOUserController::class, 'showLoginForm'])->name('ltouser.login');
Route::post('/ltouser/login', [LTOUserController::class,'login'])->name('ltouser.login.post');
Route::get('/ltouser/logout', [LTOUserController::class,'LTOuserLogout'])->name('LTOuserLogout');
Route::get('/ltouser/register', [LTOUserController::class, 'showRegistrationForm'])->name('ltouser.form');
Route::post('/ltouser/register', [LTOUserController::class, 'LTOregister'])->name('ltouser.register');


// Example PHP endpoint to get last submission form session date
Route::get('/api/getLastSubmissionDate', function() {
    // Fetch the last submission form session date from the database based on the logged-in user
    $lastSubmissionDate = Form::where('user_id', auth()->id()) // Assuming 'user_id' is the foreign key linking forms to users
                               ->latest('seasontoDate')
                               ->value('seasontoDate');
                               Log::debug('date ID: ' . $lastSubmissionDate);

    return response()->json(['lastSubmissionDate' => $lastSubmissionDate]);
});
