@extends('Taxpayer.Layouts.layout')
@section('AddRepresnetative')
<div class="container-fluid" style="padding: 2.5rem 2.5rem 1.5rem">
    <div class="col-md-12">
        <div class="card border-left-primary">
            <div class="card-header">
                <h5 class="card-title">Representative</h5>
                <h6 class="card-subtitle text-muted">Add Representative</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('representative.store') }}">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input required name="name" type="Name" class="form-control " id="name" placeholder="Name">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" name="phone" placeholder="phone" required class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" required class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection