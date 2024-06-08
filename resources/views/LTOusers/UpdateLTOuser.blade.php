@extends('LTOusers.Layouts.LTOLayout')

@section('UpdateLtouser')
<div class="container-fluid" style="padding: 2.5rem 2.5rem 1.5rem">
    <div class="col-md-12">
        <div class="card border-left-primary">
            <div class="card-header">
                <h5 class="card-title">Admin</h5>
                <h6 class="card-subtitle text-muted">Update User</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('updateLTOUser', ['id' => $user->id]) }}">
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
                    
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input required name="name" type="Name" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" name="phone" placeholder="Phone" required class="form-control" value="{{ $user->phone }}">
                        </div>
                       <div class="mb-3 col-md-4">
                        <label class="form-label" for="role">Role</label>
                        <select name="role" class="form-control">
                            <option value="Adminstative" {{ $user->role == 'Adminstative' ? 'selected' : '' }}>Adminstative</option>
                            <option value="Director" {{ $user->role == 'Director' ? 'selected' : '' }}>Director</option>
                            <option value="Manager" {{ $user->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                       </div>
                       <div class="mb-3 col-md-4">
                        <label class="form-label" for="gender">Gender</label>
                        <select name="gender" class="form-control mb-3">
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                       </div>
                    </div>
                    @if(auth()->guard('ltouser')->user()->role == 'Manager')
                        <button type="submit" class="btn btn-primary">Update</button>
                    @endif
                    <a href="/ltouser/allLtoUser" class="btn btn-secondary">Go Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
