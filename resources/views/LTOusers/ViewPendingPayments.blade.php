@extends('LTOusers.Layouts.LTOLayout')

@section('ViewPendingPayments')
    <h3>All PIT Forms</h3>
    <br>
    @if ($unpaidPayments->isEmpty())
        <p>You do not have any forms.</p>
    @else
         <!-- Form for filtering by form reference -->
    <form action="{{ route('showUnpaidPayments') }}" method="GET">
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control border-left-primary" name="form_reference" placeholder="Filter by form reference">
            </div>
            <!-- Add more filter fields as needed -->
            <div class="col">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </form>
        <table class="table table-striped table-hover shadow" style="border-radius: 2px">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Form Reference</th>
                    <th scope="col">To be Paid</th>
                    <th scope="col">Submission Date</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unpaidPayments as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->form_reference }}</td>
                        <td>{{ $form->dueTax }}</td>
                        <td>{{ $form->submission_date }}</td>
                        <td>{{ $form->payment_deadline }}</td>
                        <td>{{ $form->status }}</td>
                        <td>
                            <a href="{{ route('ViewOnePitForm',['id' => $form->id]) }}" type="button"
                                class="btn btn-primary">
                                <i class="bi bi-eye-fill" style="font-size: 1rem;"></i>
                            </a>
                            <!-- Add more actions as needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
