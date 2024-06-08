@extends('LTOusers.Layouts.LTOLayout')

@section('PITReport')
<div class="container" style="max-width: 1500px;">
    <h3>PIT Report</h3>
    <br>
    
    <!-- Filter Form -->
    <form action="{{ route('PitFormReport') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control border-left-primary" name="form_reference" placeholder="Filter by form reference" value="{{ request('form_reference') }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control border-left-primary" name="taxpayer" placeholder="Filter by taxpayer" value="{{ request('taxpayer') }}">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control border-left-primary" name="seasontoDate" placeholder="Filter by season to date" value="{{ request('seasontoDate') }}">
            </div>
            <div class="col-md-3">
                <select class="form-control border-left-primary" name="status">
                    <option value="">Filter by status</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
        </div>

            <br>
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control border-left-primary" name="uen" placeholder="Filter by UEN" value="{{ request('uen') }}">
            </div>
            
            <div class="col-md-2 ">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('export', request()->query()) }}" class="btn btn-success w-100">Export to Excel</a>
            </div>
        </div>
    </form>
    <br>
    
    <!-- Data Table -->
    <table class="table table-striped table-hover shadow">
        <thead class="table-dark">
            <tr>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Tax form Reference</th>
                <th scope="col">Taxpayer</th>
                <th scope="col">UEN</th>
                <th scope="col">Season Date from</th>
                <th scope="col">Season Date to</th>
                <th scope="col">Total</th>
                <th scope="col">differ Tax</th>
                <th scope="col">To be Paid</th>
                <th scope="col">Submission Date</th>
                <th scope="col">Due Date</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @foreach($user->forms as $form)
                    <tr>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $form->form_reference }}</td>
                        <td>{{ $form->taxpayer }}</td>
                        <td>{{ $form->uen }}</td>
                        <td>{{ $form->seasonfromDate }}</td>
                        <td>{{ $form->seasontoDate }}</td>
                        <td>{{ $form->total }}</td>
                        <td>{{ $form->dueTax }}</td>
                        <td>{{ $form->tobepaid }}</td>
                        <td>{{ $form->payment->submission_date ?? 'N/A' }}</td>
                        <td>{{ $form->payment->payment_deadline ?? 'N/A' }}</td>
                        <td>{{ $form->payment->status ?? 'N/A' }}</td>
                        
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
