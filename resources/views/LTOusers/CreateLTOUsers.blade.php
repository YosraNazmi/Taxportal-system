@extends('LTOusers.Layouts.LTOLayout')

@section('CreateLToUser')
<div class="container-fluid" style="padding: 2.5rem 2.5rem 1.5rem">
    <div class="col-md-12">
        <div class="card border-left-primary">
            <div class="card-header">
                <h5 class="card-title">Admin</h5>
                <h6 class="card-subtitle text-muted">Add New Admin</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('ltouser.register') }}">
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
                            <label class="form-label" for="name">Email</label>
                            <input type="email" name="email" placeholder="Email" required class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">Password</label>
                            <input type="password" name="password" placeholder="Password" required class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">Phone</label>
                            <input type="text" name="phone" placeholder="phone" required class="form-control">
                        </div>
                       <div class="mb-3 col-md-4">
                        <label class="form-label" for="name">Role</label>
                        <select name="role" class="form-control">
                            <option value="Adminstative">Adminstative</option>
                            <option value="Director">Director</option>
                            <option value="Manager">Manager</option>
                        </select>
                       </div>
                       <div class="mb-3 col-md-4">
                        <label class="form-label" for="name">Gender</label>
                        <select name="gender" class="form-control mb-3">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection