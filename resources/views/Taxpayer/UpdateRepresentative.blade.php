@extends('Taxpayer.Layouts.layout')
@section('UpdateRepresnetative')
<div class="container-fluid" style="padding: 2.5rem 2.5rem 1.5rem">
    <div class="col-md-12">
        <div class="card border-left-primary">
            <div class="card-header">
                <h5 class="card-title">Representative</h5>
                <h6 class="card-subtitle text-muted">Update Representative</h6>
            </div>
            
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('representative.update', $representative->id) }}">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input required name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ $representative->name }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" name="phone" placeholder="Phone" required class="form-control" value="{{ $representative->phone }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required class="form-control" value="{{ $representative->email }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" placeholder="Password"  class="form-control">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="name">status</label>
                            <select name="status" class="form-control">
                                <option value="active">active</option>
                                <option value="suspened">suspend</option>
                            </select>
                           </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-secondary" href="/viewRepresentatives">Go Back</a>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
