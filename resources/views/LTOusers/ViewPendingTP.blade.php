@extends('LTOusers.Layouts.LTOLayout')

@section('ViewPendingTP')

<div class="container mt-4">
  <div class="card shadow">
      <div class="card-header bg-dark text-white">
          <h4 class="mb-0">View User</h4>
      </div>
      <div class="card-body">
          <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Full Name:</label>
              <div class="col-sm-9">
                  <p class="form-control-plaintext text-secondary">{{ $user->firstname }} {{ $user->lastname }}</p>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">UPN:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext text-secondary">{{ $user->UPN }}</p>
            </div>
        </div>
          <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Date of Birth:</label>
              <div class="col-sm-9">
                  <p class="form-control-plaintext text-secondary">{{ $user->dob }}</p>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Type of ID:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext text-secondary">{{ $user->select }}</p>
            </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">ID Number:</label>
          <div class="col-sm-9">
              <p class="form-control-plaintext text-secondary">{{ $user->idNo}}</p>
          </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Comapny Name:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext text-secondary">{{ $user->companyName}}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Comapny UEN:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext text-secondary">{{ $user->uen}}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Comapny Type:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext text-secondary">{{ $user->category}}</p>
            </div>
        </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Address:</label>
        <div class="col-sm-9">
            <p class="form-control-plaintext text-secondary">{{ $user->addressLine1}}</p>
        </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Email:</label>
      <div class="col-sm-9">
          <p class="form-control-plaintext text-secondary">{{ $user->email }}</p>
      </div>
  </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Phone:</label>
      <div class="col-sm-9">
          <p class="form-control-plaintext text-secondary">{{ $user->ePhoneNbr }}</p>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Phone:</label>
      <div class="col-sm-9">
          <p class="form-control-plaintext text-secondary">{{ $user->ePhoneNbr }}</p>
      </div>
    </div>
          <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Status:</label>
              <div class="col-sm-9">
                  <p class="form-control-plaintext text-secondary">{{ $user->status }}</p>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Comment:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext text-secondary">{{ $user->approval_comment }}</p>
            </div>
        </div>
        
          @include('LTOusers.partials.approvalForms')
          <br>
          <a href="/ltouser/review-pending-users" class="btn btn-secondary">Go Back</a>
      </div>
  </div>
  
</div>


@endsection