@extends('LTOusers.Layouts.LTOLayout')

@section('ViewOnePayment')
<div class="container mt-4">
    <div class="card shadow border-left-primary">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">View User</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Full Name:</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext text-secondary">{{ $payment->form_reference }}</p>
                </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">UPN:</label>
              <div class="col-sm-9">
                  <p class="form-control-plaintext text-secondary">{{ $payment->dueTax }}</p>
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date of Birth:</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext text-secondary">{{ $payment->submission_date }}</p>
                </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Type of ID:</label>
              <div class="col-sm-9">
                  <p class="form-control-plaintext text-secondary">{{ $payment->payment_deadline }}</p>
              </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Number:</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext text-secondary">{{ $payment->status}}</p>
                </div>
            </div>    
            <a href="/ltouser/viewAllPayment" class="btn btn-secondary">Go Back</a>
        </div>
    </div>  
</div>
@endsection