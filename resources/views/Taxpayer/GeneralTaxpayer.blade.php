@extends('Taxpayer.Layouts.layout')

@section('GeneralTaxpayer')
<div class="container">
    <br><br>

    @if ($forms->isEmpty())
        <p>You do not have any forms.</p>
    @else

        <!-- Tax Reference Filter -->
        <form action="{{ route('filterForms') }}" method="GET" class="mb-4 ">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control shadow" name="form_reference" placeholder="Enter Tax Reference">
                </div>
                <!-- Add more filter fields as needed -->
                <div class="col">
                    <button type="submit" class="btn btnn shadow">Apply Filters</button>
                </div>
            </div>
        </form>

        <table class="table shadow" id="formsTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Reference</th>
                    <th scope="col">Taxpayer</th>
                    <th scope="col">UEN</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Total</th>
                    <th scope="col">Due Tax</th>
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
                            <a href="{{ route('ViewForm',['id' => $form->id]) }}" type="button" class="btn btnn">
                                <i class="bi bi-eye-fill" style="font-size: 1rem;"></i>
                            </a>
                            <!-- Add more actions as needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                <div>
                    <!-- Previous Button -->
                    @if ($forms->previousPageUrl())
                        <a href="{{ $forms->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                            « Previous
                        </a>
                    @endif
                </div>
        
                <div>
                    <!-- Next Button -->
                    @if ($forms->nextPageUrl())
                        <a href="{{ $forms->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                            Next »
                        </a>
                    @endif
                </div>
            </nav>
        </div>
    @endif
</div>
@endsection
