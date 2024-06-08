@extends('Taxpayer.AnnualTaxForm')

@section('AppendixFour')

<div class="custom-container  mt-5">
    <form action="{{route('AppendixFour.store')}}" method="POST">
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
        <br>
        <div class="row">
            <div class="col-12">
                <h5 class="custom-header">
                    Appendix #4 - Statement of Capital Distribution
                </h5>
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
                            <td><input type="text" id="ownershipRatio" class="form-control" value="0%" readonly></td>
                        </tr>
                    </tfoot>

                </table>
                
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <br>
    </form>
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
                <td><input type="text" name="ratio_${code}" class="form-control ratio-input"></td>
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