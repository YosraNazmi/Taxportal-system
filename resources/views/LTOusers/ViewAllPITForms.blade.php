@extends('LTOusers.Layouts.LTOLayout')

@section('AllTaxpayersForm')
<h3>All PIT Forms</h3>
<br>
@if ($forms->isEmpty())
<p>You do not have any forms.</p>
@else


<table class="table table-striped table-hover shadow " style="border-radius: 2px">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Reference</th>
            <th scope="col">Taxpayer</th>
            <th scope="col">UEN</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Total</th>
            <th scope="col">Differ Tax</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($forms as $form)
            <tr>
                <td>{{ $form->id }}</td>
                <td>{{ $form->form_reference }}</td>
                <td>{{ $form->taxpayer }}</td>
                <td>{{ $form->uen }}</td>
                <td>{{ $form->seasonfromDate }}</td>
                <td>{{ $form->seasontoDate }}</td>
                <td>{{ $form->total }}</td>
                <td>{{ $form->dueTax }}</td>
                <td>
                    <a href="{{ route('ViewOnePitForm',['id' => $form->id]) }}" type="button" class="btn btn-primary">
                        <i class="bi bi-eye-fill" style="font-size: 1rem;"></i>
                    </a>
                    <!-- Add more actions as needed -->
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endif
</div>
@endsection