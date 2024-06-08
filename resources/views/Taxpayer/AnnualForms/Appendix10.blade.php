@extends('Taxpayer.AnnualTaxForm')

@section('AppendixTen')
<div class="custom-container mt-5">
    <br>
    <h5 colspan="5" class="text-center custom-header">Appendix # 10 Statement of Previous Losses</h5>
    <form action="{{ route('AppendixTen.store') }}" method="POST">
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
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table class="table table-bordered custom-table form-table " id="loss-table">
            <thead>
            
                <tr>
                    <th>Code</th>
                    <th>Year of Origin</th>
                    <th>Year</th>
                    <th>Original Loss</th>
                    <th>Written offs in Previous Years</th>
                    <th>Written offs in the Current Year</th>
                    <th>Accumulated Loss Available for Subsequent Years (1,2,3)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td>Tax loss for the Year</td>
                    <td><input type="text" name="year_one[]" class="form-control year"></td>
                    <td><input type="text" name="original_loss_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_previous_year_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_current_year_one[]" class="form-control written_offs_current_year"></td>
                    <td><input type="text" name="accumulated_loss_one[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>110</td>
                    <td>Previous First Year</td>
                    <td><input type="text" name="year_one[]" class="form-control year"></td>
                    <td><input type="text" name="original_loss_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_previous_year_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_current_year_one[]" class="form-control written_offs_current_year"></td>
                    <td><input type="text" name="accumulated_loss_one[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>120</td>
                    <td>Previous Second Year</td>
                    <td><input type="text" name="year_one[]" class="form-control year"></td>
                    <td><input type="text" name="original_loss_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_previous_year_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_current_year_one[]" class="form-control written_offs_current_year"></td>
                    <td><input type="text" name="accumulated_loss_one[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>130</td>
                    <td>Previous Third Year</td>
                    <td><input type="text" name="year_one[]" class="form-control year"></td>
                    <td><input type="text" name="original_loss_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_previous_year_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_current_year_one[]" class="form-control written_offs_current_year"></td>
                    <td><input type="text" name="accumulated_loss_one[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>140</td>
                    <td>Previous Fourth Year</td>
                    <td><input type="text" name="year_one[]" class="form-control year"></td>
                    <td><input type="text" name="original_loss_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_previous_year_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_current_year_one[]" class="form-control written_offs_current_year"></td>
                    <td><input type="text" name="accumulated_loss_one[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>150</td>
                    <td>Previous Fifth Year</td>
                    <td><input type="text" name="year_one[]" class="form-control year"></td>
                    <td><input type="text" name="original_loss_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_previous_year_one[]" class="form-control"></td>
                    <td><input type="text" name="written_offs_current_year_one[]" class="form-control written_offs_current_year"></td>
                    <td><input type="text" name="accumulated_loss_one[]" class="form-control"></td>
                </tr>
                <tr class="footer-row">
                    <td>200</td>
                    <td colspan="4">Total</td>
                    <td><input type="text" id="total" name="total" class="form-control" readonly></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="note">
        <p><strong>Note:</strong></p>
        <small class="form-text text-muted mt-2">- The first years of loss shall be calculated as of the fiscal year in which the self-assignment system is applied, as no loss shall be counted prior to that year.</small>
        <small class="form-text text-muted mt-2">- No more than 20% of the value of the loss is allowed for the tax year in which the loss occurred.</small>
        <small class="form-text text-muted mt-2">- It is not permitted to deduct more than half of the taxable income in each of the five years.</small>
        <small class="form-text text-muted mt-2">- The loss shall only be deducted from the same source of income as it resulted from.</small>
        <small class="form-text text-muted mt-2">- The right to reduce the balance of retained losses is reduced five years after the loss is realized.</small>
    </div>
   <br>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const currentYearInputs = document.querySelectorAll('.written_offs_current_year');

    // Function to calculate the total
    const calculateTotal = () => {
        let total = 0;
        currentYearInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });
        const totalInput = document.getElementById('total');
        totalInput.value = total.toFixed(2);
    };

    // Add event listeners to calculate the total when inputs change
    currentYearInputs.forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    // Initial calculation of the total
    calculateTotal();
});

</script>






@endsection
 
