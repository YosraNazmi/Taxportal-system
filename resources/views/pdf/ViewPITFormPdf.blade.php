<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .row label {
            flex: 1 0 200px;
            font-weight: bold;
        }
        .row .input {
            flex: 2 0 400px;
            padding: 5px;
            border: 1px solid #dbdada;
            border-radius: 5px;
            background-color: #eef1f5;
        }
        .input {
            display: flex;
            align-items: center;
        }
        .col-md-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="pagetitle">PIT Tax Form</h1>
        <div class="row">
            <label for="tax-ref col-md-4 ">Tax Form Reference</label>
            <div id="tax-ref col-md-4 " class="input">{{$form->form_reference}}</div>
        </div>
        <div class="row">
            <label for="taxpayer-name">Name of Taxpayer</label>
            <div id="taxpayer-name" class="input">{{$form->taxpayer}}</div>
        </div>
        <div class="row">
            <label for="property-year-from">Property Year From</label>
            <div id="property-year-from" class="input">{{$form->propertyyearfrom}}</div>
            <label for="property-year-to">To</label>
            <div id="property-year-to" class="input">{{$form->propertuyearto}}1</div>
        </div>
        <div class="row">
            <label for="taxpayer-name">UEN</label>
            <div id="taxpayer-name" class="input">{{$form->uen}}</div>
        </div>
        <div class="row">
            <label for="season-date-from">Season Date From</label>
            <div id="season-date-from" class="input">{{$form->seasonfromDate}}</div>
            <label for="season-date-to">To Date</label>
            <div id="season-date-to" class="input">{{$form->seasontoDate}}</div>
        </div>
        <div class="row">
            <label for="tax-representative-name">Name of Tax Representative</label>
            <div id="tax-representative-name" class="input">{{$form->representativename}}</div>
        </div>
        <div class="row">
            <label for="upn">UPN</label>
            <div id="upn" class="input">{{$form->upn}}</div>
        </div>
        <div class="row">
            <label for="position">Position</label>
            <div id="position" class="input">{{$form->position}}</div>
        </div>
        <div class="row">
            <label for="phone-number">Phone Number</label>
            <div id="phone-number" class="input">{{$form->phone}}</div>
        </div>
        <div class="row">
            <label for="number-of-employees">Number of Employees</label>
            <div id="number-of-employees" class="input">{{$form->numberofEmployee}}</div>
        </div>
        <div class="row">
            <label for="salary-wages">Salary & Wages</label>
            <div id="salary-wages" class="input">{{$form->salaryandwages}}</div>
        </div>
        <div class="row">
            <label for="allowances">Allowances</label>
            <div id="allowances" class="input">{{$form->Allowancess}}</div>
        </div>
    </div>
</body>
</html>
