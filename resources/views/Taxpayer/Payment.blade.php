@extends('Taxpayer.Layouts.layout')
@section('Payment')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="pagetitle">Payment Page</h1>
                <br><br>
                <p>Your reference number: {{ $reference }}</p>
                <p>Here you would have payment forms or details.</p>
            </div>
        </div>
        
    </div>
@endsection
