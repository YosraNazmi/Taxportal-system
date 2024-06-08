@extends('LTOusers.Layouts.LTOLayout')

@section('LTOuserDashboard')
<title>LTO Office</title>
<div id="dashboard" class="dashboard">
    <div class="container">
        <h1 class="pagetitle">Dashboard</h1>
        <br><br>
        <div class="container">
            <h3 class="pagetitle">Taxpayer Services</h3>
            <div class="row" style="display: flex">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ $pendingUsersCount }}</h5><!-- Display the count here -->
                            <a href="{{ route('review-pending-users') }}"> <!-- Update the href with the actual route -->
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <h6 class="h5 mb-0 font-weight-bold mb-1">New Taxpayers</h6>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-people" style="color: blue"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <h5 class="card-title">{{$rejectedUsers}}</h5>
                            <a href="{{ route('rejectedUser') }}">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <h6 class="h5 mb-0 font-weight-bold mb-1">Rejected Users</h6>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-fill-x" style="color: red"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <a href="">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <h6 class="h5 mb-0 font-weight-bold mb-1">VAT</h6>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-cash fa-2x"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <a href="">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <h6 class="h5 mb-0 font-weight-bold mb-1">Annual Tax</h6>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-calendar fa-2x"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h3 class="pagetitle">Payment Services</h3>
            <div class="row" style="display: flex">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ $unpaidPaymentsCount }}</h5>
                            <a href="{{route('showUnpaidPayments')}}">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <h6 class="h5 mb-0 font-weight-bold mb-1">Pending Payments</h6>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-credit-card-2-front"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ $allPayments }}</h5>
                            <a href="{{route('viewAllPayment')}}">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <h6 class="h5 mb-0 font-weight-bold mb-1">All Payments</h6>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-credit-card-2-back"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="pagetitle">Charts</h3>
            <div class="row" style="display: flex">
                <div class="col-xl-4">
                    <div class="card shadow h-100 py-2">
                        <div class="card-body">
                            <h5 class="card-title">Taxpayer & Due Tax</h5>
                            <canvas id="taxpayersDueTaxChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card shadow h-100 py-2">
                        <div class="card-body">
                            <h5 class="card-title">Number of Form Filler</h5>
                            <canvas id="userFormChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card shadow h-100 py-2">
                        <div class="card-body">
                            <h5 class="card-title">Users Submission Statistics</h5>
                            <canvas id="submissionStatisticsChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>
<script>
    // Fetch data from the backend
    fetch('/dashboard/taxpayers-due-tax')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('taxpayersDueTaxChart').getContext('2d');

            // Create the chart
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.taxpayers,
                    datasets: [{
                        label: 'Due Tax',
                        data: data.due_tax,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>
<script>
    fetch('/dashboard/user-form-count')
        .then(response => response.json())
        .then(users => {
            const ctx = document.getElementById('userFormChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: users.map(user => user.firstname), // Assuming user has a 'firstname' attribute
                    datasets: [{
                        label: 'Number of Forms',
                        data: users.map(user => user.forms_count), // Assuming user's forms count is named 'forms_count'
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>
<script>
    // Fetch data from the backend
    fetch('/dashboard/submission-statistics')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('submissionStatisticsChart').getContext('2d');

            // Create the chart
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Submitted', 'Not Submitted'],
                    datasets: [{
                        label: 'Users',
                        data: [data.submitted, data.not_submitted],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
</script>
@endsection
