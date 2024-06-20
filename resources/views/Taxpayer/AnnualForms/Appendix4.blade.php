@extends('Taxpayer.AnnualTaxForm')

@section('AppendixFour')
@php
    // Check if form data exists
    $formData = \App\Models\AppendixFour::where('user_id', auth()->id())->get();
@endphp
<div class="custom-container mt-5">
    <br>
    <h5 class="custom-header">
        Appendix #4 - Statement of Capital Distribution
    </h5>
    @if ($formData->isNotEmpty())
        {{-- Display the form data for updating --}}
        <form id="appendixFourForm" action="{{ route('updateAppendixFour') }}" method="POST">
            @csrf
            @method('PUT')
            <table class="custom-table table-bordered table form-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Corporations, Institutions and Individuals with Shares in the Capital (Ownership ratio > 10%)</th>
                        <th>Tax Number</th>
                        <th>Nationality</th>
                        <th>Legal Form</th>
                        <th>Ownership Ratio %</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formData as $index => $row)
                        <tr>
                            <td>{{ 100 + ($index * 10) }}</td>
                            <td><input type="text" name="corporation[]" class="form-control" value="{{ $row->corporation }}"></td>
                            <td><input type="text" name="tax_number[]" class="form-control" value="{{ $row->tax_number }}"></td>
                            <td><input type="text" name="nationality[]" class="form-control" value="{{ $row->nationality }}"></td>
                            <td><input type="text" name="legal_form[]" class="form-control" value="{{ $row->legal_form }}"></td>
                            <td><input type="text" name="ownership_ratio[]" class="form-control ratio-input" value="{{ $row->ownership_ratio }}"></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>200</td>
                        <td colspan="4" class="text-left">Total</td>
                        <td>{{ $formData->sum('ownership_ratio') }}%</td>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-info"><a href="{{ route('appendix.show', ['number' => 5]) }}">Next</a></button>
        </form>
       
    @else
        {{-- Display the form for the user to fill --}}
        <form id="appendixFourForm" action="{{ route('AppendixFour.store') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display success message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display error message -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <br>
            <input type="hidden" name="appendix_number" value="4">
            <div class="row">
                <div class="col-12">
                    <table class="custom-table table-bordered table form-table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Corporations, Institutions and Individuals with Shares in the Capital (Ownership ratio > 10%)</th>
                                <th>Tax Number</th>
                                <th>Nationality</th>
                                <th>Legal Form</th>
                                <th>Ownership Ratio %</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>100</td>
                                <td><input type="text" name="corporation[]" class="form-control"></td>
                                <td><input type="text" name="tax_number[]" class="form-control"></td>
                                <td><input type="text" name="nationality[]" class="form-control"></td>
                                <td><input type="text" name="legal_form[]" class="form-control"></td>
                                <td><input type="text" name="ownership_ratio[]" class="form-control ratio-input"></td>
                            </tr>
                            <tr>
                                <td>110</td>
                                <td><input type="text" name="corporation[]" class="form-control"></td>
                                <td><input type="text" name="tax_number[]" class="form-control"></td>
                                <td><input type="text" name="nationality[]" class="form-control"></td>
                                <td><input type="text" name="legal_form[]" class="form-control"></td>
                                <td><input type="text" name="ownership_ratio[]" class="form-control ratio-input"></td>
                            </tr>
                            <tr>
                                <td>120</td>
                                <td><input type="text" name="corporation[]" class="form-control"></td>
                                <td><input type="text" name="tax_number[]" class="form-control"></td>
                                <td><input type="text" name="nationality[]" class="form-control"></td>
                                <td><input type="text" name="legal_form[]" class="form-control"></td>
                                <td><input type="text" name="ownership_ratio[]" class="form-control ratio-input"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>200</td>
                                <td colspan="4" class="text-left">Total</td>
                                <td id="ownershipRatio"><input type="text" id="ownershipRatio" name="ownershipRatio" class="form-control" value="0" readonly></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const tbody = document.querySelector('table.custom-table tbody');
        const ownershipRatio = document.getElementById('ownershipRatio');

        function addRow(code) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${code}</td>
                <td><input type="text" name="corporation[]" class="form-control"></td>
                <td><input type="text" name="tax_number[]" class="form-control"></td>
                <td><input type="text" name="nationality[]" class="form-control"></td>
                <td><input type="text" name="legal_form[]" class="form-control"></td>
                <td><input type="text" name="ownership_ratio[]" class="form-control ratio-input"></td>
            `;
            tbody.appendChild(newRow);

            // Add event listeners to new inputs
            const newInputs = newRow.querySelectorAll('.form-control');
            newInputs.forEach(input => {
                input.addEventListener('input', handleInputChange);
            });
        }

        function handleInputChange() {
            // Check if all inputs in the last row are filled
            const lastRow = tbody.querySelector('tr:last-child');
            const inputs = lastRow.querySelectorAll('.form-control');
            let allFilled = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    allFilled = false;
                }
            });

            // If all inputs are filled, add a new row
            if (allFilled) {
                const nextCode = parseInt(lastRow.cells[0].textContent) + 10;
                addRow(nextCode);
            }

            // Update the ownership ratio
            updateOwnershipRatio();
        }

        function updateOwnershipRatio() {
            let sum = 0;
            const ratioInputs = document.querySelectorAll('.ratio-input');
            ratioInputs.forEach(input => {
                const value = parseFloat(input.value) || 0;
                sum += value;
            });
            ownershipRatio.value = sum + '%';
        }

        // Add event listeners to initial inputs
        const initialInputs = document.querySelectorAll('.form-control');
        initialInputs.forEach(input => {
            input.addEventListener('input', handleInputChange);
        });

        // Initial calculation
        updateOwnershipRatio();
    });
</script>
@endsection
