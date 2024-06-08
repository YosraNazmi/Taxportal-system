@extends('LTOusers.Layouts.LTOLayout')

@section('ChartReport')
<div class="container" style="max-width: 1500px;">
    <h3>PIT Report</h3>
    <br>
    
    <!-- Filter Form -->
    <form id="chartForm" method="POST" action="{{ route('exportChartData') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <select class="form-control" id="xAxis" name="xAxis">
                    <option value="users.firstname">First Name</option>
                    <option value="users.lastname">Last Name</option>
                    <option value="forms.form_reference">Form Reference</option>
                    <option value="forms.taxpayer">Taxpayer</option>
                    <option value="forms.uen">UEN</option>
                    <option value="forms.seasonfromDate">Season Date From</option>
                    <option value="forms.seasontoDate">Season Date To</option>
                    <option value="forms.total">Total</option>
                    <option value="forms.dueTax">Due Tax</option>
                    <option value="payments.submission_date">Submission Date</option>
                    <option value="payments.payment_deadline">Payment Deadline</option>
                    <option value="payments.status">Status</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="yAxis" name="yAxis">
                    <option value="users.firstname">First Name</option>
                    <option value="users.lastname">Last Name</option>
                    <option value="forms.form_reference">Form Reference</option>
                    <option value="forms.taxpayer">Taxpayer</option>
                    <option value="forms.uen">UEN</option>
                    <option value="forms.seasonfromDate">Season Date From</option>
                    <option value="forms.seasontoDate">Season Date To</option>
                    <option value="forms.total">Total</option>
                    <option value="forms.dueTax">Due Tax</option>
                    <option value="payments.submission_date">Submission Date</option>
                    <option value="payments.payment_deadline">Payment Deadline</option>
                    <option value="payments.status">Status</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Generate Chart</button>
                
            </div>
            <div class="col-md-2">
                <a href="#" id="exportChartData" class="btn btn-success">Export Chart Data</a>
            </div>
            
        </div>
    </form>
    <br>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.getElementById('chartForm').addEventListener('submit', function (e) {
    e.preventDefault();
    
    const xAxis = document.getElementById('xAxis').value;
    const yAxis = document.getElementById('yAxis').value;

    fetch("{{ route('chart.data') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ xAxis, yAxis })
    })
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: `${yAxis} vs ${xAxis}`,
                    data: data.data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching chart data:', error);
    });
});

document.getElementById('exportChartData').addEventListener('click', function (e) {
    e.preventDefault();

    const xAxis = document.getElementById('xAxis').value;
    const yAxis = document.getElementById('yAxis').value;

    // Construct the export URL with selected axis values
    const exportUrl = "{{ route('exportChartData') }}?xAxis=" + xAxis + "&yAxis=" + yAxis;

    // Redirect to the export URL
    window.location.href = exportUrl;
});
</script>
@endsection
