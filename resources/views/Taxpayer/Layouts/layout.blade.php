<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/newstyle.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head>
    <title>Tax dashboard</title>
</head>
<style>
    .pit-uen {
        color: blue !important; /* Change the color to blue for PIT UEN */
    }
    .lto-uen {
        color: rgb(255, 0, 242) !important; /* Change the color to yellow for LTO UEN */
    }
</style>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg-white shadow">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <a href="{{route('tp.dashboard')}}"><h3>Tax</h3></a>
                    <div class="d-flex align-items-center">
                        <ul class="navbar-nav">
                            
                            <li class="nav-item">
                                <a>
                                    UEN: {{ auth()->check() ? auth()->user()->uen : '' }} 
                                    <i class="bi bi-bookmark-star-fill @if(auth()->check() && auth()->user()->approval_type == 'PIT') pit-uen @else lto-uen @endif"></i>
                                </a>
                            </li>
                            &nbsp;&nbsp;
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-bell"></i>
                                    @auth
                                        <span class="badge bg-primary badge-number">0</span>
                                    @endauth
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                
                                    <a class="dropdown-item" href="#"></a>
                                </div>
                            </li>
                                                                   
                            <!-- User Account Dropdown -->
                            &nbsp;&nbsp;
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <i class="bi bi-person-circle"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <h6 class="dropdown-header">
                                        @auth
                                            {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                                        @endauth
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center"  href="{{route('showRepresentative')}}">
                                        Add Representative
                                     </a>
                                    <a class="dropdown-item d-flex align-items-center"  href="{{ route('userLogout') }}">
                                        Logout
                                     </a>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </nav>          

    <div class="container">
        @yield('TPDashboard')
        @yield('ApplyPIT')
        @yield('Payment')
        @yield('GeneralTaxpayer')
        @yield('ViewForm')
        @yield('ViewDuePayments')
        @yield('ViewOneDuePayment')
        @yield('AddRepresnetative')
        @yield('UpdateRepresnetative')
        @yield('ViewRepresentative')
        @yield('GenerateReport')
       
        
    </div>
    @yield('AnnualTaxForm')
   
</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

</html>