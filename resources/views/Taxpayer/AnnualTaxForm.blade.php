@extends('Taxpayer.Layouts.layout')

@section('AnnualTaxForm')

<style>
    .custom-table {
        width: 100%;
        text-align: center;
        border-collapse: collapse;
    }
    
    .custom-table th, .custom-table td {
        border: 1px solid #ddd;
        padding: 8px;
        
    }
    .custom-table th {
        background-color: #f2f2f2;
    }
    .custom-header {
        background-color: #e3f2fd;
        text-align: center;
        padding: 10px 0;
        border-radius: 5px;
    }
    .custom-header-2 {
        text-align: center;
        padding: 10px 0;
        
    }
    input{
       border-bottom: 1px solid #007BFF !important; 
       border: none !important;
       /*margin: 10px !important;*/
    }
    input[readonly] {
    background-color: #EAECEE;
}
    .custom-container {
        max-width: 960px; /* Customize this value as needed */
        margin: 0 auto;
        padding: 0 15px; /* Optional padding */
    }
    .form-table th,
    .form-table td {
        vertical-align: middle !important;
    }
    .note {
        font-size: 0.9rem;
        margin-top: 20px;
    }
    .menu a {
            display: block;
            margin: 10px 0;
            color: rgba(28, 63, 85, 0.8);
        }
    .c-container{
        max-width: 400px;
        background-color: #f8f9fc;
        padding: 30px;
    }
</style>
<div id="wrapper" class="d-flex" style="min-height: 100vh;">
    <!-- Page Content -->
    <div id="content-wrapper" class="flex-grow-1">
        <div class="container my-3" style="max-width: 1300px;">
            <div class="row">
                <div class="col-md-2">
                    <br><br><br>
                    <h5>Annual Form Menu</h5>
                    <div class="menu">
                        <a href="{{ route('formA') }}">1. Corporate Income Tax Declaration</a>
                        <a href="{{ route('appendixOne') }}">2. Appendix 1 Budget Statement</a>
                        <a href="{{ route('appendixTwo') }}">3. Appendix 2 Income Statement</a>
                        <a data-bs-toggle="collapse" href="#collapseTaxpayer" role="button" aria-expanded="false" aria-controls="collapseTaxpayer">4. Appendix Forms</a>
                        <ul class="collapse" id="collapseTaxpayer">
                            @foreach(range(4, 27) as $i)
                                <li>
                                    <a id="appendix{{ $i }}" href="{{ route('appendix.show', ['number' => $i]) }}">
                                        Appendix {{ $i }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>                                            
                        <a href="{{ route('formF') }}">5. Appendix 3 Transitioning from Accounting to Tax Results</a>
                        <a href="{{ route('formC') }}">6. Annexes for the Income tax of Companies</a>
                    </div>
                </div>

                <div class="col-md-10">
                    <!-- Main content -->
                    <div class="container">
                        @yield('anouncements')
                        @yield('FormD')
                        @yield('FormE')
                        @yield('FormC')
                        @yield('AppendixFour')
                        @yield('AppendixFive')
                        @yield('AppendixSix')
                        @yield('AppendixSeven')
                        @yield('AppendixEight')
                        @yield('AppendixNine')
                        @yield('AppendixTen')
                        @yield('AppendixEleven')
                        @yield('AppendixTwelve')
                        @yield('AppendixThirteen')
                        @yield('AppendixFourteen')
                        @yield('AppendixFifteen')
                        @yield('AppendixSixteen')
                        @yield('AppendixSeventeen')
                        @yield('AppendixEighteen')
                        @yield('AppendixNineteen')
                        @yield('AppendixTwenty')
                        @yield('AppendixTwentyOne')
                        @yield('AppendixTwentyTwo')
                        @yield('AppendixTwentyThree')
                        @yield('AppendixTwentyFour')
                        @yield('AppendixTwentyFive')
                        @yield('AppendixTwentySix')
                        @yield('AppendixTwentySeven')
                        @yield('FormF')
                        @yield('FormA')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
