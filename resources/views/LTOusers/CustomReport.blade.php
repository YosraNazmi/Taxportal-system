@extends('LTOusers.Layouts.LTOLayout')

@section('CustomReport')
<br>
<h3>Generate Custom Report</h3>
<br>
<form method="POST" action="{{ route('generate.custom.report') }}">
    @csrf
    <div class="row mb-3">
        <div class="col-md-3">
            
            <select class="form-control" name="field1" id="field1">
                <optgroup label="Users Table">
                    <option value="users.firstname">First Name</option>
                    <option value="users.lastname">Last Name</option>
                    <option value="users.UPN">UPN</option>
                    <option value="users.dob">Date of Birth</option>
                    <option value="users.category">Category</option>
                    <option value="users.idNo">ID Number</option>
                    <option value="users.companyName">Company Name</option>
                    <option value="users.uen">UEN</option>
                    <option value="users.addressLine1">Address Line 1</option>
                    <option value="users.city">City</option>
                    <option value="users.country">Country</option>
                    <option value="users.postalCode">Postal Code</option>
                    <option value="users.ePhoneNbr">Phone Number</option>
                    <option value="users.email">Email</option>
                    <option value="users.status">Status</option>
                </optgroup>
            </select>
        </div>
        <div class="col-md-3">
            
            <select class="form-control" name="field2" id="field2">
                <optgroup label="Forms Table">
                    <option value="forms.form_reference">Form Reference</option>
                    <option value="forms.taxpayer">Taxpayer</option>
                    <option value="forms.propertyyearfrom">Property Year From</option>
                    <option value="forms.propertuyearto">Property Year To</option>
                    <option value="forms.uen">UEN</option>
                    <option value="forms.quarter">Quarter</option>
                    <option value="forms.seasonfromDate">Season From Date</option>
                    <option value="forms.seasontoDate">Season To Date</option>
                    <option value="forms.representativename">Representative Name</option>
                    <option value="forms.upn">UPN</option>
                    <option value="forms.position">Position</option>
                    <option value="forms.phone">Phone</option>
                    <option value="forms.numberofEmployee">Number of Employee</option>
                    <option value="forms.salaryandwages">Salary and Wages</option>
                    <option value="forms.Allowancess">Allowances</option>
                    <option value="forms.bonus">Bonus</option>
                    <option value="forms.total">Total</option>
                    <option value="forms.retire">Retire</option>
                    <option value="forms.Gallowances">G Allowances</option>
                    <option value="forms.summary">Summary</option>
                    <option value="forms.examptions">Exemptions</option>
                    <option value="forms.taxAmount">Tax Amount</option>
                    <option value="forms.dueTax">Differ Tax</option>
                    <option value="forms.delayone">Delay One</option>
                    <option value="forms.dalaytwo">Delay Two</option>
                    <option value="forms.dalaythree">Delay Three</option>
                    <option value="forms.totaloftaxpen">Total of Tax Penalty</option>
                    <option value="forms.delayinterest">Delay Interest</option>
                    <option value="forms.paidamount">Paid Amount</option>
                    <option value="forms.blanace">Balance</option>
                    <option value="forms.remainingbalance">Remaining Balance</option>
                    <option value="forms.tobepaid"> Amount To be Paid</option>
                    <option value="forms.agreeCheckbox">Agree Checkbox</option>
                </optgroup>
                <optgroup label="Payments Table">
                    <option value="payments.form_reference">Form Reference</option>
                    <option value="payments.dueTax">Amount to be Paid</option>
                    <option value="payments.submission_date">Submission Date</option>
                    <option value="payments.payment_deadline">Payment Deadline</option>
                    <option value="payments.status">Status</option>
                </optgroup>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Generate Report</button>
        </div>       
    </div>
</form>
<br>
@if(isset($results))
    <h2>Report Results</h2>
    <table class="table table-striped table-hover shadow" style="border-radius: 2px">
        <thead class="table-dark">
            <tr>
                <th>{{ ucfirst(explode('.', $field1)[1]) }}</th>
                <th>{{ ucfirst(explode('.', $field2)[1]) }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->{explode('.', $field1)[1]} }}</td>
                    <td>{{ $result->{explode('.', $field2)[1]} }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
