@extends('LTOusers.Mainlayout')

@section('user-section')
    <h2>Rejected Users</h2>
    @include('LTOusers.partials.user_table', ['users' => $rejectedUsers])
@endsection