@extends('Taxpayer.AnnualTaxForm')

@section('AppendixSeventeen')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixSeventeen::where('user_id', auth()->id())->get();
@endphp
<div class="custom-container mt-5">
   <h5 class="text-center custom-header">Appendix #17 A Statement of Activity via the Internet</h5>
   <br>
   @if ($formData->isNotEmpty())
   <form action="{{ route('updateAppendixSeventeen') }}" method="POST">
    @csrf
    @method('PUT')
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
    @foreach ($formData as $index => $data)
    <div class="form-group">
        @if ($index === 0)
            <label for="numPages">Number of pages or websites of the company:</label>
            <input value="{{ $data->page_number }}" class="form-control" name="page_number" id="numPages" placeholder="Enter number">
        @endif
        <label for="website{{$index + 1}}">Enter address for page or website {{ $index + 1 }}:</label>
        <input value="{{ $data->url }}" class="form-control" name="websites[]" id="website{{$index + 1}}" placeholder="http://">
    </div>
    @endforeach
    <div class="form-group">
        <label for="revenuePercentage">What is the percentage of revenues through the websites towards the total revenues of the company:</label>
        <input value="{{ $formData->first()->revenue_percentage }}" class="form-control" name="revenue_percentage" id="revenuePercentage" placeholder="Enter percentage">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Update</button>
    <button type="button" class="btn btn-info" id="prevButton">
        <a href="{{ route('appendix.show', ['number' => 16]) }}">Previous</a>
    </button>
    <button type="button" class="btn btn-info" id="prevButton">
        <a href="{{ route('appendix.show', ['number' => 18]) }}">Next</a>
    </button>
   </form>
   @else
   <form action="{{ route('AppendixSeventeen.store') }}" method="POST">
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
       <div class="form-group">
           <label for="numPages">Number of pages or websites of the company:</label>
           <input style="background-color: transparent;  border-bottom: 1px solid #9fa2a5 !important;" type="number" class="form-control" name="page_number" id="numPages" placeholder="Enter number">
       </div>
       <div class="form-group">
           <label for="website1">Enter addresses for pages or websites:</label>
           <input style="background-color: transparent;  border-bottom: 1px solid #9fa2a5 !important;" type="url" class="form-control" name="websites[]" id="website1" placeholder="http://">
       </div>
       <div class="form-group">
           <input style="background-color: transparent;  border-bottom: 1px solid #9fa2a5 !important;" type="url" class="form-control" name="websites[]" id="website2" placeholder="http://">
       </div>
       <div class="form-group">
           <label for="revenuePercentage">What is the percentage of revenues through the websites towards the total revenues of the company:</label>
           <input style="background-color: transparent;  border-bottom: 1px solid #9fa2a5 !important;" type="number" name="revenue_percentage" class="form-control" id="revenuePercentage" placeholder="Enter percentage">
       </div>
       <br>
       <button type="submit" class="btn btn-primary">Submit</button>
       <button type="button" class="btn btn-info" id="prevButton">
        <a href="{{ route('appendix.show', ['number' => 17]) }}">Previous</a>
    </button>
   </form>
   @endif
   <br>
   <div class="form-footer">
       <small class="form-text text-muted mt-2">This statement is being filled by companies that have revenue generated through pages or websites.</small>
   </div>
</div>
@endsection
