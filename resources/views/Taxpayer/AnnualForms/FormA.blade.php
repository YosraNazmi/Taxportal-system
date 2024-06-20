
@extends('Taxpayer.AnnualTaxForm')
@section('FormA')
<style>
    .custom-container {
        max-width: 960px; /* Customize this value as needed */
        margin: 0 auto;
        padding: 0 15px; /* Optional padding */
    }
   
    .step-circle {
      width: 30px;
      height: 30px;
      border: 2px solid #1e3e54;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      background-color: white;
      color: #1e3e54;
      font-weight: bold;
  }
  
  .step-circle.active {
      background-color: #007bff !important;
      color: white !important;
      border: 2px solid #007bff ;
  }
  .step-circle.completed {
      background-color: #1e3e54;
      color: white;
      border-color: #1e3e54;
  }

</style>

<div class="custom-container">
    <br><br>
    <div class="progress px-1" style="height: 3px;">
        <div style="background-color: #1e3e54 ;" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="step-container d-flex justify-content-between">
        <div class="step-circle" id="step-circle-1" onclick="displayStep(1)">1</div>
        <div class="step-circle" id="step-circle-2" onclick="displayStep(2)">2</div>
    </div>
    <form action="{{ route('submitFormA') }}" method="POST" id="multi-step-form">
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
            <!--FormA input-->
            <div class="step step-1">
                <h3 class="mt-4">Income Tax Declaration for Companies</h3>
                <br>
                <div class="form-section">
                    <div class="row">        
                        <div class="form-group col-md-4">
                            <label for="financialYearFrom" class="form-label">Financial Year From (Day, Month, Year)</label>
                            <input type="date" class="form-control" id="financialYearFrom" name="financialYearFrom" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="financialYearTo" class="form-label">Financial Year To (Day, Month, Year)</label>
                            <input type="date" class="form-control" id="financialYearTo" name="financialYearTo" required>
                        </div>
                    </div>
                </div>
                <br>
              <!--  
                
                <br>
                <div class="form-section">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="taxNo" class="form-label">Tax No.</label>
                            <input type="text" class="form-control" id="taxNo" value="{{Auth::user()->uen }}" name="uen" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="financialYearFrom" class="form-label">Financial Year From (Day, Month, Year)</label>
                            <input type="date" class="form-control" id="financialYearFrom" name="financialYearFrom" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="financialYearTo" class="form-label">Financial Year To (Day, Month, Year)</label>
                            <input type="date" class="form-control" id="financialYearTo" name="financialYearTo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" value="{{Auth::user()->companyName }}" name="companyName" required>
                    </div>
                </div>
        
                Section 2: Current Company Address 
                <div class="form-section">
                    <h4>Current Company Address</h4>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" value="{{Auth::user()->addressLine1 }}" name="address" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" value="{{Auth::user()->city }}" name="city" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" value="{{Auth::user()->country }}" name="country" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="postalCode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" value="{{Auth::user()->postalCode }}" name="postalCode" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="phone1" class="form-label">Phone (1)</label>
                            <input type="text" class="form-control" id="phone1" value="{{Auth::user()->ePhoneNbr }}" name="phone1" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="phone2" class="form-label">Phone (2)</label>
                            <input type="text" class="form-control" id="phone2" name="phone2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email }}" required>
                    </div>
                </div>
                <br> -->
                <!-- Section 4: Other Information -->

                <div class="form-section" id="legalStructureChangeSection">
                    <div class="form-group">
                        <label>Has company's legal structure changed during the year?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="legalStructureChange" id="legalStructureChangeYes" value="yes" required>
                            <label class="form-check-label" for="legalStructureChangeYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="legalStructureChange" id="legalStructureChangeNo" value="no" required>
                            <label class="form-check-label" for="legalStructureChangeNo">No</label>
                        </div>
                    </div>
                    <div class="form-group" id="legalStructureChangeFields">
                        <label for="legalStructureChangeDate" class="form-label">Change Date (Day, Month, Year)</label>
                        <input type="date" class="form-control" id="legalStructureChangeDate" name="legalStructureChangeDate">
                        <label for="newLegalStructure" class="form-label">New Legal Structure</label>
                        <input type="text" class="form-control" id="newLegalStructure" name="newLegalStructure">
                    </div>
                </div>
                <br>
                <div class="form-section" id="mainActivityChangeSection">
                    <div class="form-group">
                        <label>Has company's main activity changed during the year?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mainActivityChange" id="mainActivityChangeYes" value="yes" required>
                            <label class="form-check-label" for="mainActivityChangeYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mainActivityChange" id="mainActivityChangeNo" value="no" required>
                            <label class="form-check-label" for="mainActivityChangeNo">No</label>
                        </div>
                    </div>
                    <div class="form-group" id="mainActivityChangeFields">
                        <label for="mainActivityChangeSpecify" class="form-label">Specify</label>
                        <input type="text" class="form-control" id="mainActivityChangeSpecify" name="mainActivityChangeSpecify">
                    </div>
                </div>
                <br>
                <div class="form-section" id="companyConsolidatedSection">
                    <div class="form-group">
                        <label>Has the company been consolidated during the year?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="companyConsolidated" id="companyConsolidatedYes" value="yes" required>
                            <label class="form-check-label" for="companyConsolidatedYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="companyConsolidated" id="companyConsolidatedNo" value="no" required>
                            <label class="form-check-label" for="companyConsolidatedNo">No</label>
                        </div>
                    </div>
                    <div class="form-group" id="companyConsolidatedFields">
                        <label for="companyConsolidationDate" class="form-label">Consolidation Date (Day, Month, Year)</label>
                        <input type="date" class="form-control" id="companyConsolidationDate" name="companyConsolidationDate">
                    </div>
                </div>
                <br>
                <div class="form-section" id="subsidiaryLiquidatedSection">
                    <div class="form-group">
                        <label>Has the subsidiary been liquidated during the current financial year?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="subsidiaryLiquidated" id="subsidiaryLiquidatedYes" value="yes" required>
                            <label class="form-check-label" for="subsidiaryLiquidatedYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="subsidiaryLiquidated" id="subsidiaryLiquidatedNo" value="no" required>
                            <label class="form-check-label" for="subsidiaryLiquidatedNo">No</label>
                        </div>
                    </div>
                    <!-- No additional fields for subsidiary liquidation -->
                </div>
                <br>
                <div class="form-section" id="branchClosedSection">
                    <div class="form-group">
                        <label>Has any branch or office of the company been closed during the current financial year?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="branchClosed" id="branchClosedYes" value="yes" required>
                            <label class="form-check-label" for="branchClosedYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="branchClosed" id="branchClosedNo" value="no" required>
                            <label class="form-check-label" for="branchClosedNo">No</label>
                        </div>
                    </div>
                    <!-- No additional fields for branch closure -->
                </div>
                <br>
                <div class="form-section" id="activitiesAbroadSection">
                    <div class="form-group">
                        <label>Did the company carry out any activities abroad during the current financial year?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="companyLiquidated" id="activitiesAbroadYes" value="yes" required>
                            <label class="form-check-label" for="activitiesAbroadYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="companyLiquidated" id="activitiesAbroadNo" value="no" required>
                            <label class="form-check-label" for="activitiesAbroadNo">No</label>
                        </div>
                    </div>
                    <div class="form-group" id="activitiesAbroadFields">
                        <label for="accountingSystem" class="form-label">If yes, specify the country</label>
                        <input type="text" class="form-control" id="accountingSystem" name="accountingSystem">
                    </div>
                </div>
                <br>
        
                <br>
                <button type="button" class="btn btn-primary next-step">Next</button>   
                <br>
                <br>
            
            </div>
            <!--FormB inputs-->
            <div class="step step-2">
                <h3 class="mt-4">Income Tax Declaration for Companies</h3>
                <!-- Section 10-17: Tax Calculation -->
                <div class="form-section">
                    <br>
                    <h5>Tax Calculation</h5>
                    <div class="form-group row">
                        <label for="netTaxableIncome" class="col-sm-6 col-form-label">10. Net taxable income (transition statement: appendix no 3 - Line 600)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="netTaxableIncome" name="netTaxableIncome" value="{{$netTaxableIncome}}">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="previousYearsLosses" class="col-sm-6 col-form-label">11. Previous years losses (appendix no 10)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control highlight" id="previousYearsLosses"  name="previousYearsLosses" value="{{$previousYearsLosses}}">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="taxableIncome" class="col-sm-6 col-form-label">12. Taxable income</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control highlight" id="taxableIncome" name="taxableIncome">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="taxRatio" class="col-sm-6 col-form-label">13. Tax ratio</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="taxRatio" name="taxRatio" value="15%" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="toBePaidTax" class="col-sm-6 col-form-label">14. To be paid tax</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control highlight" id="toBePaidTax" name="toBePaidTax" value="0">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="foreignTaxAdoption" class="col-sm-6 col-form-label">15. Adoption of foreign tax (appendix no 26)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control highlight" id="foreignTaxAdoption" name="foreignTaxAdoption" value="{{$foreignTaxAdoption}}">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="taxDeducted" class="col-sm-6 col-form-label">16. Tax deducted from transactions during tax year (appendix no 27)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="taxDeducted" name="taxDeducted" value="{{$taxDeducted}}">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="netPayableTax" class="col-sm-6 col-form-label">17. Net payable tax</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control highlight" id="netPayableTax" name="netPayableTax">
                        </div>
                    </div>
                    <br>
                </div>
                <br>
                <!-- Section: Submission of the Declaration -->
                <div class="form-section">
                    <h4>Submission of the Declaration</h4>
                    <div class="form-group">
                        <label>Name and signature of the executive manager responsible for the accuracy and completeness of the information included in this declaration with its annexes.</label>
                        
                        <div class="row">
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
                <br>
                <!-- Section: Auditor Information -->
                <div class="form-section">
                    <h4>Auditor who has approved the financial information</h4>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="auditorName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="auditorName" name="auditorName">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="auditorPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="auditorPhone" name="auditorPhone">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="auditorEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="auditorEmail" name="auditorEmail">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <small class="form-text text-muted">
                            Note: The inaccuracy of the information provided in this declaration leads to penalty of the article no (8) in the resolution no. (102) for the year 2017.
                        </small>
                    </div>
                </div>
                <br>
        
                <!-- Section: Administration Specific -->
                <div class="form-section">
                    <h4>Administration Specific</h4>
                    <div class="row">
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
                <br>
            
            
                <br>
                <button type="button" class="btn btn-primary prev-step">Previous</button>
                <button type="submit">Submit</button>
                <br>
                <br>
            </div>
    </form> 
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentStep = 1;
    
        // Hide all steps except the first one initially
        $('#multi-step-form').find('.step').slice(1).hide();
    
        // Initialize step circles
        updateStepCircles();
    
        $(".next-step").click(function() {
            if (validateStep(currentStep)) {
                if (currentStep < 2) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                    currentStep++;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                        $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
                        updateProgressBar();
                        updateStepCircles();
                        window.scrollTo(0, 0);
                    }, 500);
                }
            }
        });
    
        $(".prev-step").click(function() {
            if (currentStep > 1) {
                $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
                currentStep--;
                setTimeout(function() {
                    $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                    $(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
                    updateProgressBar();
                    updateStepCircles();
                    window.scrollTo(0, 0);
                }, 500);
            }
        });
    
        function updateProgressBar() {
            var progressPercentage = ((currentStep - 1) / 2) * 100;
            $(".progress-bar").css("width", progressPercentage + "%");
        }
    
        function updateStepCircles() {
            $(".step-circle").removeClass("active completed");
            for (var i = 1; i <= currentStep; i++) {
                $("#step-circle-" + i).addClass(i === currentStep ? "active" : "completed");
            }
        }
    
        function validateStep(step) {
            var isValid = true;
            $(".step-" + step).find('input, select, textarea').each(function() {
                if ($(this).prop('required') && !$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return isValid;
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to toggle visibility of fields for each section
        function toggleSectionFields(sectionName, fieldIds) {
            const sectionYes = document.getElementById(sectionName + 'Yes');
            const sectionNo = document.getElementById(sectionName + 'No');
            const sectionFields = document.getElementById(sectionName + 'Fields');

            function toggleFields() {
                sectionFields.style.display = sectionYes.checked ? 'block' : 'none';
            }

            // Add event listeners to the radio buttons
            sectionYes.addEventListener('change', toggleFields);
            sectionNo.addEventListener('change', toggleFields);

            // Initial state check
            toggleFields();
        }

        // Call toggleSectionFields for each section with their respective field IDs
        toggleSectionFields('legalStructureChange', ['legalStructureChangeDate', 'newLegalStructure']);
        toggleSectionFields('mainActivityChange', ['mainActivityChangeSpecify']);
        toggleSectionFields('companyConsolidated', ['companyConsolidationDate']);
        toggleSectionFields('subsidiaryLiquidated', []); // No additional fields for subsidiary liquidation
        toggleSectionFields('branchClosed', []); // No additional fields for branch closure
        toggleSectionFields('activitiesAbroad', ['accountingSystem']);
    });
</script>





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
@endsection