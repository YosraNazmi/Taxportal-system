<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/newstyle.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
   
</head>
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
    <div id="wrapper" class="d-flex" style="min-height: 100vh">
        <!-- Sidebar -->
        <nav id="sidebar" class="text-white bg-gradient-primary" style="background-color: #000000; color: #fff">
            <div class="sidebar-header p-4">
                <p style="color: #ffffff"> 
                    @auth('ltouser')
                        {{ auth()->guard('ltouser')->user()->name }}
                        {{ auth()->guard('ltouser')->user()->role }}
                    @endauth
                </p>
            </div>
            <hr class="sidebar-divider my-0">
            <ul class="nav flex-column components">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('ltouser.dashboard') }}" ><i class="bi bi-speedometer2"style="font-size:1rem; vertical-align:bottom; padding:10px;"></i>Dashboard</a>
                </li>
                
                <!-- Taxpayer Section -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#collapseTaxpayer" role="button" aria-expanded="false" aria-controls="collapseTaxpayer">
                        <i class="bi bi-people" style="font-size:1rem; vertical-align:bottom; padding:10px;"></i>Taxpayers
                    </a>
                    <ul class="collapse" id="collapseTaxpayer">
                        <li><a class="nav-link " href="{{route('allTaxpayers')}}">All Taxpayers</a></li>
                        <li><a class="nav-link " href="">Taxpayers Report</a></li>
                    </ul>
                </li>
                
                <!-- Form Section -->
                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-file-earmark-bar-graph" style="font-size:1rem; vertical-align:bottom; padding:10px;"></i> Forms
                    </a>
                    <ul class="collapse" id="collapseExample">
                        <li><a class="nav-link" href="{{route('viewAllPitForms')}}">PIT Form</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="collapse" href="#collapsePayment" role="button" aria-expanded="false" aria-controls="collapsePayment">
                        <i class="bi bi-credit-card-2-front-fill" style="font-size:1rem; vertical-align:bottom; padding:10px;"></i>Payment
                    </a>
                    <ul class="collapse" id="collapsePayment">
                        <li><a class="nav-link" href="{{route('viewAllPayment')}}">PIT Payments</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="collapse" href="#collapseAdmin" role="button" aria-expanded="false" aria-controls="collapseAdmin">
                        <i class="bi bi-person-lines-fill" style="font-size:1rem; vertical-align:bottom; padding:10px;"></i> Admins
                    </a>
                    <ul class="collapse" id="collapseAdmin">
                        <li><a class="nav-link" href="{{route('allLtoUser')}}">Admins</a></li>
                       
                        @auth <!-- Check if the user is authenticated -->
                            @if(auth()->guard('ltouser')->user()->role == 'Manager') <!-- Check if the user's role is 'Manager' -->
                                <li><a class="nav-link" href="{{ route('NewAdmin') }}">Create Admin</a></li>
                            @endif
                        @endauth
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="collapse" href="#collapseReport" role="button" aria-expanded="false" aria-controls="collapseReport">
                        <i class="bi bi-bar-chart-fill" style="font-size:1rem; vertical-align:bottom; padding:10px;"></i>Reprts
                    </a>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('PitFormReport')}}">PIT form Report</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('dynamic-chart')}}">PIT Chart Report</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('allTaxpayers')}}">Tax by Taxpayer</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('CategoryReport')}}">Tax by Sector</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('QuarterReport')}}">Tax by quarter</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('paymentReport')}}">Payments by Taxpayer</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('usersWithoutForms')}}">None Fillers</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('usersWithForms')}}">Fillers</a></li>
                    </ul>
                    <ul class="collapse" id="collapseReport">
                        <li><a class="nav-link" href="{{route('show.custom.report.form')}}">Custome Report</a></li>
                    </ul>
                    
                </li>
            </ul>
        </nav>
        
        <!-- Page Content -->
        <div id="content-wrapper" class="flex-grow-1">
            <!-- Topbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light bg-white shadow">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <h2></h2>
                        <div class="d-flex align-items-center">
                            <ul class="navbar-nav">
                                <!-- Notifications Account Dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-bell"></i>
                                        <span class="badge bg-primary badge-number">{{ auth()->guard('ltouser')->user()->unreadNotifications->count() }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        @foreach(auth()->guard('ltouser')->user()->unreadNotifications as $notification)
                                            <div class="notification-item">
                                                <i class="bi bi-arrow-right"></i>
                                                <a href="{{ route('rejectedUser') }}">
                                                  <h4>User: {{ $notification->data['user_name'] }}</h4>
                                                  <p>{{ $notification->data['message'] }}</p>
                                                  <p>Reason: {{ $notification->data['reason'] }}</p>
                                                </a>
                                            </div>
                                            <hr>
                                        @endforeach

                                        <!-- Optionally mark notifications as read -->
                                        {{ auth()->user()->unreadNotifications->markAsRead() }}
                                    </div>
                                </li>
                                <!-- User Account Dropdown -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="bi bi-person-circle"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <h6 class="dropdown-header">
                                            @auth('ltouser')
                                                {{ auth()->guard('ltouser')->user()->name }}
                                            @endauth
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center"  href="{{ route('LTOuserLogout') }}">
                                            Logout
                                         </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>            

            <!-- Main content -->
            <div class="container my-3">
                @yield('LTOuserDashboard')
                @yield('ReviewPendingUsers')
                @yield('ViewPendingTP')
                @yield('RejectedUsers')
                @yield('ViewRejectedUser')
                @yield('AllTaxpayers')
                @yield('ViewOneTaxpayer')
                @yield('CreateLToUser')
                @yield('ViewAllLtoUsers')
                @yield('UpdateLtouser')
                @yield('AllTaxpayersForm')
                @yield('ViewOnePitForm')
                @yield('ViewALLPayments')
                @yield('ChartReport')
                @yield('ViewOnePayment')
                @yield('ViewPendingPayments')
                @yield('CategoryReport')
                @yield('QuarterReport')
                @yield('PaymentReport')
                @yield('UsersWithoutForms')
                @yield('UsersWithForms')
                @yield('CustomReport')
                
            </div>
            @yield('PITReport')
        </div>
    </div>
</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</html>