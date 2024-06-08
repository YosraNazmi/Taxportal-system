@extends('Taxpayer.Layouts.layout')

@section('TPDashboard')
    
<br>
        <nav class="navbar  dash-navbar">
            <div class="container-fluid">
              <a class="navbar-brand" href="#" style="color:#fff;">General Services</a>
            </div>
        </nav> 
        <div class="container text-center">
            <br>
            <div class="row gx-5 justify-content-center">
                <div class="col-md-2">
                    <div class="card h-100" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                        <div class="card-header" style="background-color: #d6dde4">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <div class="card-body">
                            <a href="{{route('applyPIT')}}">Apply for PIT Tax</a>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card h-100 " style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                        <div class="card-header" style="background-color: #d6dde4">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('viewAnnualTaxForm') }}">Apply for Annual Tax income</a>
                        </div>  
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card h-100 disabled" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                        <div class="card-header" style="background-color: #d6dde4">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <div class="card-body">
                            <a href="">Apply for Real Estate Tax</a>
                        </div>  
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card h-100" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                        <div class="card-header" style="background-color: #d6dde4">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <div class="card-body">
                            <a href="{{route('RetrivePaymentt')}}">Payments</a>
                        </div>  
                    </div>
                </div>
            </div>
            <br>
            <div class="row gx-5 justify-content-center">
                <div class="col-md-2">
                    <div class="card h-100" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                        <div class="card-header" style="background-color: #d6dde4">
                            <i class="bi bi-archive"></i>
                        </div>
                        <div class="card-body">
                            <a href="{{route('GeneralTax')}}">Archieves</a>
                        </div>  
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card h-100" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                        <div class="card-header" style="background-color: #d6dde4">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                        <div class="card-body">
                            <a href="{{route('generateReport')}}">Reports</a>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <br>
        <nav class="navbar  dash-navbar">
            <div class="container-fluid">
              <a class="navbar-brand" href="#" style="color:#fff;">withdrawal Tax</a>
            </div>
        </nav> 
        <br>
        <div class="row gx-5 justify-content-center">
            <div class="col-md-2">
                <div class="card h-100 disabled" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                    <div class="card-header" style="background-color: #d6dde4">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div class="card-body">
                        <a href="">Objections</a>
                    </div>  
                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100 disabled" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                    <div class="card-header" style="background-color: #d6dde4">
                        <i class="bi bi-file-earmark-plus"></i>
                    </div>
                    <div class="card-body">
                        <a href="">Apply for withdrawal Form</a>
                    </div>  
                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100 disabled" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                    <div class="card-header" style="background-color: #d6dde4">
                        <i class="bi bi-clipboard-data"></i>
                    </div>
                    <div class="card-body">
                        <a href="">withdrawal Apeal</a>
                    </div>  
                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100 disabled" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                    <div class="card-header" style="background-color: #d6dde4">
                        <i class="bi bi-clipboard-data"></i>
                    </div>
                    <div class="card-body">
                        <a href="">withdrawal Return</a>
                    </div>  
                </div>
            </div>
        </div>
        <br>
        <nav class="navbar  dash-navbar">
            <div class="container-fluid">
              <a class="navbar-brand" href="#" style="color:#fff;">Other Services</a>
            </div>
        </nav>
        <br>
        <div class="row gx-5 justify-content-center">
            <div class="col-md-2">
                <div class="card h-100 disabled" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                    <div class="card-header" style="background-color: #d6dde4">
                        <i class="bi bi-clipboard-data"></i>
                    </div>
                    <div class="card-body">
                        <a href="">Audit</a>
                    </div>  
                </div>
            </div>
            <div class="col-md-2">
                <div class="card h-100 disabled" style="background-color: #d6dde4; -webkit-align-items: flex-start;">
                    <div class="card-header" style="background-color: #d6dde4">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div class="card-body">
                        <a href="">Objections</a>
                    </div>  
                </div>
            </div>
        </div>
@endsection