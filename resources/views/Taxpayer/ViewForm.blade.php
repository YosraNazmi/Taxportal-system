@extends('Taxpayer.Layouts.layout')

@section('TPDashboard')
<div class="container">
    <br>
    <h1 class="pagetitle">View PIT Tax Form</h1>
    <br>
    <a href="{{ route('download.form.pdf', ['id' => $form->id]) }}" class="btn btnn">Download PDF</a>
    <a href="{{ route('exportToExcel') }}" class="btn btn-primary">Download Excel</a>
    <br>
    <form>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="taxpayer" class="form-label">Tax Form Reference</label>
                <input type="text" class="form-control" id="taxpayer" name="taxpayer" value="{{ $form->form_reference }}" disabled>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-4 mb-3">
                <label for="taxpayer" class="form-label">Name of Taxpayer</label>
                <input type="text" class="form-control" id="taxpayer" name="taxpayer" value="{{ $form->taxpayer }}" disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="propertuyearfrom" class="form-label">Property Year From</label>
                <span>From</span><input class="form-control" id="propertyyearfrom" name="propertyyearfrom" value="{{$form->propertyyearfrom}}" disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="propertuyearto" class="form-label">To</label>
                <input  class="form-control" id="propertuyearto" name="propertuyearto" value="{{$form->propertuyearto}}" disabled>
            </div>
            <div class="col-md-4 mb-3">
                <label for="uen" class="form-label">UEN</label>
                <input type="text" class="form-control" id="uen" name="uen" value="{{ $form->uen }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="seasonfromDate" class="form-label">Season Date From</label>
                <input  class="form-control" id="seasonfromDate" name="seasonfromDate" value="{{ $form->seasonfromDate}}" disabled>
            </div>
            <div class="col-md-4">
                <label for="seasontoDate" class="form-label">To Date</label>
                <input  class="form-control" id="seasontoDate" name="seasontoDate" value="{{ $form->seasontoDate}}" disabled>
            </div>
        </div>
        <hr class="hr-dashboard">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="repname" class="form-label">Name of Tax Representative</label>
                <input  class="form-control" id="representativename" name="representativename" value="{{ $form->representativename}}" disabled>
            </div>
            <div class="col-md-3 mb-3">
                <label for="upn" class="form-label">UPN</label>
                <input type="text" class="form-control" id="upn" name="upn" value="{{ $form->upn}}" disabled>
            </div>
            <div class="col-md-3 mb-3">
                <label for="position" class="form-label">Position</label>
                <input  class="form-control" id="position" name="position" value="{{ $form->position}}" disabled>
            </div>
            <div class="col-md-3 mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input class="form-control" id="phone" name="phone" value="{{ $form->phone}}" disabled>
            </div>
        </div>
        <hr class="hr-dashboard">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="numberofEmployee" class="form-label">Number of Employess</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class=" input-group-text custom-label" id="basic-addon1">100</span>
                <input  class="form-control" id="numberofEmployee" name="numberofEmployee" value="{{ $form->numberofEmployee}}" disabled >
            </div>
        </div>
        <hr class="hr-dashboard">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="salaryandwages" class="form-label">Salary & Wages</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">200</span>
                <input class="form-control" id="salaryandwages" name="salaryandwages" value="{{ $form->salaryandwages}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="Allowancess" class="form-label">Allowancess</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">210</span>
                <input  class="form-control" id="Allowancess" name="Allowancess" value="{{ $form->Allowancess}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="bonus" class="form-label">Bonuses</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">220</span>
                <input  class="form-control" id="bonus" name="bonus" value="{{ $form->bonus}}"  disabled>         
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="total" class="form-label">Total</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">230</span>
                <input  style="background-color: #e5f1f6;"  type="text" class="form-control" id="total" name="total" value="{{ $form->total}}" disabled>
                <!-- Hidden input field to store the calculated total -->
                <input type="hidden" id="totalHidden" name="totalHidden">      
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="retire" class="form-label">Social Security & Retirement</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">240</span>
                <input  class="form-control" id="retire" name="retire" value="{{ $form->retire}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="Gallowances" class="form-label">Gtranted Allowances</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">250</span>
                <input   class="form-control" id="Gallowances" name="Gallowances" value="{{ $form->Gallowances}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="summary" class="form-label">Summary</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">260</span>
                <input style="background-color: #e5f1f6;" type="text" class="form-control" id="summary" name="summary" value="{{ $form->summary}}" disabled>
                <!-- Hidden input field to store the calculated summary -->
                <input type="hidden" id="summeryHidden" name="summaryHidden"> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="examptions" class="form-label">Exampltions</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">270</span>
                <input  class="form-control" id="examptions" name="examptions" value="{{ $form->examptions}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="taxAmount" class="form-label">Lable Tax Amount</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">280</span>
                <input style="background-color: #e5f1f6;"  type="text" class="form-control" id="taxAmount" name="taxAmount" value="{{ $form->taxAmount}}" disabled>
                <!-- Hidden input field to store the calculated taxAmout -->
                <input type="hidden" id="taxAmountHidden" name="taxAmountHidden"> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="taxRate" class="form-label">Tax Rate</label>
            </div>
            <div class="col-md-9 mb-3"> 
                <lable  class="form-control" id="taxRate" name="taxRate"> %5</lable>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="dueTax" class="form-label">Due Tax</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">290</span>
                <input   style="background-color: #e5f1f6;"  type="text" class="form-control" id="dueTax" name="dueTax" value="{{ $form->taxAmount}}" disabled>
                <!-- Hidden input field to store the calculated taxAmout -->
                <input type="hidden" id="dueTaxHidden" name="dueTaxHidden"> 
            </div>
        </div>
        <hr class="hr-dashboard">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="delayone" class="form-label">Penalty for Delay %5</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">300</span>
                <input  class="form-control" id="delayone" name="delayone" value="{{ $form->delayone}}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="dalaytwo" class="form-label">Penalty for Delay %10</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">310</span>
                <input  class="form-control" id="dalaytwo" name="dalaytwo" value="{{ $form->dalaytwo}}"  disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="dalaythree" class="form-label">Penalty for not Submitting the Seasonal Report</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">320</span>
                <input  type="text" class="form-control" id="dalaythree" name="dalaythree"  value="{{ $form->dalaythree}}" disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="totaloftaxpen" class="form-label">Total of Taxes and Penalties</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">330</span>
                <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="totaloftaxpen" name="totaloftaxpen"  value="{{ $form->totaloftaxpen}}"  disabled>
                <!-- Hidden input field to store the calculated total -->
                <input type="hidden" id="totalTaxHidden" name="totalTaxHidden">      
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="delayinterest" class="form-label">Delay Interest</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">340</span>
                <input  type="text" class="form-control" id="delayinterest" name="delayinterest" value="{{ $form->delayinterest}}"  disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="paidamount" class="form-label">Total Amount that needs to be Paid</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">350</span>
                <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="paidamount" name="paidamount"  value="{{ $form->paidamount}}"  disabled>
                 <!-- Hidden input field to store the calculated total -->
                 <input type="hidden" id="paidamountHidden" name="paidamountHidden">   
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="blanace" class="form-label">Balance as a result of paying additional taxes in previous seasons</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">360</span>
                <input  type="text" class="form-control" id="blanace" name="blanace"  value="{{ $form->blanace}}"  disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="remainingbalance" class="form-label">Total Remaining balance</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">370</span>
                <input  type="text" class="form-control" id="remainingbalance" name="remainingbalance"  value="{{ $form->remainingbalance}}"  disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="tobepaid" class="form-label">Summary of final Amount to be paid</label>
            </div>
            <div class="col-md-3 mb-3 input-group" style="width: 75%"> 
                <span class="input-group-text custom-label" id="basic-addon1">380</span>
                <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="tobepaid" name="tobepaid"  value="{{ $form->tobepaid}}" disabled>
                 <!-- Hidden input field to store the calculated total -->
                 <input type="hidden" id="tobepaidhidden" name="tobepaidhidden">  
            </div>
        </div>
        <br><br>
         <a href="/taxpayer/general" class="btn btnn">Go back</a>
    </form>
</div>
@endsection