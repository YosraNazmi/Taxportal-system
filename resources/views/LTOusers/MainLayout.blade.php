@extends('LTOusers.Layouts.LTOLayout')
@section('content')
<div class="container mt-4">
    <h1>User Management</h1>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('ltouser/review-pending-users') ? 'active' : '' }}" href="{{ route('review-pending-users') }}">New User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('user/rejected') ? 'active' : '' }}" href="{{ route('rejected.user') }}">Rejected by Manager</a>
        </li>
    </ul>

    <div>
        @yield('user-section')
    </div>
</div>
@endsection