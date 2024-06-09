
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
            <div class="step step-1">
                
                <h3 class="mt-4">Income Tax Declaration for Companies</h3>
                <br>
                <div class="form-section">
                    <div class="form-row">
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
        
                <!-- Section 2: Current Company Address -->
                <div class="form-section">
                    <h4>Current Company Address</h4>
                    <div class="form-row">
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
                    <div class="form-row">
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

                <!-- Section 4: Other Information -->
                <div class="form-section">
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
                    <div class="form-group">
                        <label for="legalStructureChangeDate" class="form-label">Change Date (Day, Month, Year)</label>
                        <input type="date" class="form-control" id="legalStructureChangeDate" name="legalStructureChangeDate">
                    </div>
                    <div class="form-group">
                        <label for="newLegalStructure" class="form-label">New Legal Structure</label>
                        <input type="text" class="form-control" id="newLegalStructure" name="newLegalStructure">
                    </div>
                </div>
        
                <div class="form-section">
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
                        <div class="form-group">
                            <label for="mainActivityChangeSpecify" class="form-label">Specify</label>
                            <input type="text" class="form-control" id="mainActivityChangeSpecify" name="mainActivityChangeSpecify">
                        </div>
                    </div>
                </div>
        
                <div class="form-section">
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
                        <div class="form-group">
                            <label for="companyConsolidationDate" class="form-label">Consolidation Date (Day, Month, Year)</label>
                            <input type="date" class="form-control" id="companyConsolidationDate" name="companyConsolidationDate">
                        </div>
                    </div>
                </div>
        
                <div class="form-section">
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
                    <div class="form-group">
                        <label>Did the company carry out any activities abroad during the current financial year?</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="activitiesAbroad" id="activitiesAbroadYes" value="yes" required>
                            <label class="form-check-label" for="activitiesAbroadYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="activitiesAbroad" id="activitiesAbroadNo" value="no" required>
                            <label class="form-check-label" for="activitiesAbroadNo">No</label>
                        </div>
                        <div class="form-group">
                            <label for="activitiesAbroadCountry" class="form-label">If yes, specify the country</label>
                            <input type="text" class="form-control" id="activitiesAbroadCountry" name="activitiesAbroadCountry">
                        </div>
                    </div>
                </div>
        
                <br>
                <button type="button" class="btn btn-primary next-step">Next</button>   
                <br>
                <br>
            
            </div>
            <div class="step step-2">
                @include('Taxpayer.AnnualForms.FormB')
                <br>
                <button type="button" class="btn btn-primary prev-step">Previous</button>
                <button type="submit" class="btn btn-success">Submit</button> 
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

        const legalStructureChangeYes = document.getElementById("legalStructureChangeYes");
        const legalStructureChangeNo = document.getElementById("legalStructureChangeNo");
        const mainActivityChangeYes = document.getElementById("mainActivityChangeYes");
        const mainActivityChangeNo = document.getElementById("mainActivityChangeNo");
        const companyConsolidatedYes = document.getElementById('companyConsolidatedYes');
        const companyConsolidatedNo = document.getElementById('companyConsolidatedNo')

        legalStructureChangeYes.addEventListener('change', function() {
            toggleOptionalFields('legalStructureChangeYes', ['legalStructureChangeDate', 'newLegalStructure']);
        });
        legalStructureChangeNo.addEventListener('change', function() {
            toggleOptionalFields('legalStructureChangeYes', ['legalStructureChangeDate', 'newLegalStructure']);
        });

        mainActivityChangeYes.addEventListener('change', function() {
            toggleOptionalFields('mainActivityChangeYes', ['mainActivityChangeSpecify']);
        });
        mainActivityChangeNo.addEventListener('change', function() {
            toggleOptionalFields('mainActivityChangeYes', ['mainActivityChangeSpecify']);
        });

        companyConsolidatedYes.addEventListener('change', function() {
            toggleOptionalFields('companyConsolidatedYes', ['companyConsolidationDate']);
        });
        companyConsolidatedNo.addEventListener('change', function() {
            toggleOptionalFields('companyConsolidatedNo', ['companyConsolidationDate']);
        });



        function toggleOptionalFields(radioButtonId, fieldIds) {
            const isVisible = document.getElementById(radioButtonId).checked;
            fieldIds.forEach(fieldId => {
                document.getElementById(fieldId).style.display = isVisible ? 'block' : 'none';
            });
        }

        toggleOptionalFields('legalStructureChangeYes', ['legalStructureChangeDate', 'newLegalStructure']);
        toggleOptionalFields('mainActivityChangeYes', ['mainActivityChangeSpecify']);
        toggleOptionalFields('companyConsolidatedYes', ['companyConsolidationDate']);

    });
</script>
@endsection