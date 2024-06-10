
    <h3 class="mt-4">Income Tax Declaration for Companies</h3>
        <!-- Section 10-17: Tax Calculation -->
        <div class="form-section">
            <h5>Tax Calculation</h5>
            <div class="form-group row">
                <label for="netTaxableIncome" class="col-sm-6 col-form-label">10. Net taxable income (transition statement: appendix no 3 - Line 600)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="netTaxableIncome" name="netTaxableIncome" value="{{$netTaxableIncome}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="previousYearsLosses" class="col-sm-6 col-form-label">11. Previous years losses (appendix no 10)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control highlight" id="previousYearsLosses"  name="previousYearsLosses" value="{{$previousYearsLosses}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="taxableIncome" class="col-sm-6 col-form-label">12. Taxable income</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control highlight" id="taxableIncome" name="taxableIncome">
                </div>
            </div>
            <div class="form-group row">
                <label for="taxRatio" class="col-sm-6 col-form-label">13. Tax ratio</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="taxRatio" name="taxRatio" value="15%" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="toBePaidTax" class="col-sm-6 col-form-label">14. To be paid tax</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control highlight" id="toBePaidTax" name="toBePaidTax" value="0">
                </div>
            </div>
            <div class="form-group row">
                <label for="foreignTaxAdoption" class="col-sm-6 col-form-label">15. Adoption of foreign tax (appendix no 26)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control highlight" id="foreignTaxAdoption" name="foreignTaxAdoption" value="{{$foreignTaxAdoption}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="taxDeducted" class="col-sm-6 col-form-label">16. Tax deducted from transactions during tax year (appendix no 27)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="taxDeducted" name="taxDeducted" value="{{$taxDeducted}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="netPayableTax" class="col-sm-6 col-form-label">17. Net payable tax</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control highlight" id="netPayableTax" name="netPayableTax">
                </div>
            </div>
        </div>
        <!-- Section: Submission of the Declaration -->
        <div class="form-section">
            <h4>Submission of the Declaration</h4>
            <div class="form-group">
                <label>Name and signature of the executive manager responsible for the accuracy and completeness of the information included in this declaration with its annexes.</label>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="execManagerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="execManagerName" name="execManagerName">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="execManagerDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="execManagerDate" name="execManagerDate">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Auditor Information -->
        <div class="form-section">
            <h4>Auditor who has approved the financial information</h4>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="auditorName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="auditorName" name="auditorName">
                </div>
                <div class="form-group col-md-4">
                    <label for="auditorPhone" class="form-label">Phone</label>
                    <input type="phone" class="form-control" id="auditorPhone" name="auditorPhone">
                </div>
                <div class="form-group col-md-4">
                    <label for="auditorEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="auditorEmail" name="auditorEmail">
                </div>
            </div>
            <div class="form-group">
                <small class="form-text text-muted">
                    Note: The inaccuracy of the information provided in this declaration leads to penalty of the article no (8) in the resolution no. (102) for the year 2017.
                </small>
            </div>
        </div>

        <!-- Section: Administration Specific -->
        <div class="form-section">
            <h4>Administration Specific</h4>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inwardNumber" class="form-label">Inward number in the declarations documents</label>
                    <input type="text" class="form-control" id="inwardNumber" name="inwardNumber">
                </div>
                <div class="form-group col-md-3">
                    <label for="inwardDate" class="form-label">Date of inward in the declarations documents</label>
                    <input type="date" class="form-control" id="inwardDate" name="inwardDate">
                </div>
                <div class="form-group col-md-3">
                    <label for="employeeName" class="form-label">Employee Name</label>
                    <input type="text" class="form-control" id="employeeName" name="employeeName">
                </div>
                <div class="form-group col-md-3">
                    <label for="entryDate" class="form-label">Entry Date</label>
                    <input type="date" class="form-control" id="entryDate" name="entryDate">
                </div>
            </div>
        </div>
    

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const netTaxableIncomeInput = document.getElementById('netTaxableIncome');
        const previousYearsLossesInput = document.getElementById('previousYearsLosses');
        const taxableIncomeInput = document.getElementById('taxableIncome');
        const taxRatioInput = document.getElementById('taxRatio');
        const toBePaidTaxInput = document.getElementById('toBePaidTax');
        const foreignTaxAdoptionInput = document.getElementById('foreignTaxAdoption');
        const taxDeductedInput = document.getElementById('taxDeducted');
        const netPayableTaxInput = document.getElementById('netPayableTax');

        // Function to calculate taxable income
        function calculateTaxableIncome() {
            const netTaxableIncome = parseFloat(netTaxableIncomeInput.value) || 0;
            const previousYearsLosses = parseFloat(previousYearsLossesInput.value) || 0;
            taxableIncomeInput.value = netTaxableIncome + previousYearsLosses;
        }

        // Function to calculate to be paid tax
       // Function to calculate to be paid tax
        function calculateToBePaidTax(){
            const taxableIncome = parseFloat(taxableIncomeInput.value) || 0;
            const taxRatio = parseFloat(taxRatioInput.value) || 0;
            const calculatedTax = (taxableIncome * (taxRatio / 100)).toFixed(2);
            toBePaidTaxInput.value = calculatedTax;
        }

        // Function to calculate net payable tax
        function calculateNetPayableTax() {
            const toBePaidTax = parseFloat(toBePaidTaxInput.value) || 0;
          //  const taxDeducted = parseFloat(taxDeductedInput.value) || 0;
            const foreignTaxAdoption = parseFloat(foreignTaxAdoptionInput.value) || 0;
            netPayableTaxInput.value = (toBePaidTax  - foreignTaxAdoption).toFixed(2);
        }

        const inputs = ['netTaxableIncome', 'previousYearsLosses', 'taxableIncome', 'taxRatio',
    'toBePaidTax', 'foreignTaxAdoption','taxDeducted','netPayableTax'];
    inputs.forEach(id => {
        const inputElement = document.getElementById(id);
        if (inputElement) {
            inputElement.addEventListener('input', function() {
                calculateNetPayableTax();

        // Trigger initial calculations
        calculateTaxableIncome();
        calculateToBePaidTax();
        calculateNetPayableTax();
            });
        }
    });

        calculateNetPayableTax();

        // Trigger initial calculations
        calculateTaxableIncome();
        calculateToBePaidTax();
        calculateNetPayableTax();
    });
</script>