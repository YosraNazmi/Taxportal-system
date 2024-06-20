@extends('Taxpayer.Layouts.layout')
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
@section('ApplyPIT')

<div class="container">
    <br><br>
    <div class="progress px-1" style="height: 3px;">
        <div style="background-color: #1e3e54 ;"  class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="step-container d-flex justify-content-between">
        <div class="step-circle" id="step-circle-1" onclick="displayStep(1)">1</div>
        <div class="step-circle" id="step-circle-2" onclick="displayStep(2)">2</div>
        <div class="step-circle" id="step-circle-3" onclick="displayStep(3)">3</div>
        
    </div>
    <div class="mt-5">
        @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>     
    <form action="{{ route('NewForm.Post') }}" method="POST" id="multi-step-form">
        @csrf

        <div class="step step-1">
            <h3>Agreement</h3>
            <hr class="hr-dashboard">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreeCheckbox" name="agreeCheckbox" required>
                        <label class="form-check-label" for="agreeCheckbox">
                            I agree that the provided information is correct and up to date
                        </label>
                    </div>
                </div>
            </div> 
            <br>
            <button type="button" class="btn btn-primary next-step">Next</button>   
        </div>
        <div class="step step-2">
            <h3>Taxpayer Information</h3>
            <hr class="hr-dashboard">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="taxpayer" class="form-label">Name of Taxpayer</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="taxpayer" name="taxpayer" value="{{ Auth::user()->firstname }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="propertuyearfrom" class="form-label">Financial Year From</label>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" id="propertyyearfrom" name="propertyyearfrom" required>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" id="propertuyearto" name="propertuyearto" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="uen" class="form-label">UEN</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="uen" name="uen" value="{{ Auth::user()->uen }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="seasonfromDate" class="form-label">Season Date From</label>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Quarter</label>
                    <select class="form-control" id="quarter" name="quarter" required>
                        <option value="" selected disabled>Select Quarter</option>
                        <option value="Q1">Q1 (Jan - Mar)</option>
                        <option value="Q2">Q2 (Apr - Jun)</option>
                        <option value="Q3">Q3 (Jul - Sep)</option>
                        <option value="Q4">Q4 (Oct - Dec)</option>
                    </select>
                    <div id="quarterError" class="alert alert-danger mt-2" style="display: none;"></div>
                    @error('quarter')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="seasonfromDate" class="form-label">Season Date From</label>
                    <input type="date" class="form-control" id="seasonfromDate" name="seasonfromDate" readonly>
                </div>
                <div class="col-md-3">
                    <label for="seasontoDate" class="form-label">Season Date To</label>
                    <input type="date" class="form-control" id="seasontoDate" name="seasontoDate" readonly>
                </div>
            </div>
            
            <hr class="hr-dashboard">
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label class="form-label">Select Tax Representative</label>
                </div>
                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="repType" id="repTypeYes" value="yes">
                        <label class="form-check-label" for="repTypeYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="repType" id="repTypeNo" value="no" checked>
                        <label class="form-check-label" for="repTypeNo">No</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3 rep-fields" style="display: none;">
                <div class="col-md-4"> 
                    <label for="repname" class="form-label">Name of Tax Representative</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="representativename" name="representativename">
                </div>
            </div>
            <div class="row mb-3 rep-fields" style="display: none;">
                <div class="col-md-4"> 
                    <label for="upn" class="form-label">UPN</label>
                </div>
                <div class="col-md-8 rep-fields" style="display: none;">
                    <input type="text" class="form-control" id="upn" name="upn" >
                </div>
            </div>
            <div class="row mb-3 rep-fields" style="display: none;">
                <div class="col-md-4"> 
                    <label for="position" class="form-label">Position</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="position" name="position" >
                </div>
            </div>
            <div class="row mb-3 rep-fields" style="display: none;">
                <div class="col-md-4"> 
                    <label for="phone" class="form-label">Phone Number</label>
                </div>
                <div class="col-md-8">
                    <input type="phone" class="form-control" id="phone" name="phone" >
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-primary prev-step">Previous</button>
            <button type="button" class="btn btn-primary next-step">Next</button> 
        </div>
        <div class="step step-3">
            <h3>Employees</h3>
            <hr class="hr-dashboard">
            <br>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="numberofEmployee" class="form-label">Number of Employess</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class=" input-group-text custom-label" id="basic-addon1">100</span>
                    <input type="text" class="form-control" id="numberofEmployee" name="numberofEmployee" required>
                </div>
            </div>
            <hr class="hr-dashboard">
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="numberofEmployee" class="form-label">Number of Employess</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">200</span>
                    <input type="text" class="form-control" id="salaryandwages" name="salaryandwages" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="Allowancess" class="form-label">Allowancess</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">210</span>
                    <input type="text" class="form-control" id="Allowancess" name="Allowancess" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="bonus" class="form-label">Bonuses</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">220</span>
                    <input type="text" class="form-control" id="bonus" name="bonus" required>     
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="total" class="form-label">Total</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">230</span>
                    <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="total" name="total" required>
                    <!-- Hidden input field to store the calculated total -->
                    <input type="hidden" id="totalHidden" name="totalHidden">     
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="retire" class="form-label">Social Security & Retirement</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">240</span>
                    <input  type="text" class="form-control" id="retire" name="retire" required>     
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="Gallowances" class="form-label">Gtranted Allowances</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">250</span>
                    <input  type="text" class="form-control" id="Gallowances" name="Gallowances" required>     
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="summary" class="form-label">Summary</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">260</span>
                    <input readonly style="background-color: #e5f1f6;" type="text" class="form-control" id="summary" name="summary" required>
                    <!-- Hidden input field to store the calculated summary -->
                    <input type="hidden" id="summeryHidden" name="summaryHidden">    
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="examptions" class="form-label">Exampltions</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">270</span>
                    <input  type="text" class="form-control" id="examptions" name="examptions" required>    
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="taxAmount" class="form-label">Lable Tax Amount</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">280</span>
                    <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="taxAmount" name="taxAmount" required>
                    <!-- Hidden input field to store the calculated taxAmout -->
                    <input type="hidden" id="taxAmountHidden" name="taxAmountHidden">   
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="taxRate" class="form-label">Tax Rate</label>
                </div>
                <div class="col-md-6 input-group">
                    <lable   class="form-control" id="taxRate" name="taxRate"> %5</lable> 
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4"> 
                    <label for="dueTax" class="form-label">Differ Tax</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">290</span>
                    <input readonly  style="background-color: #e5f1f6;"  type="text" class="form-control" id="dueTax" name="dueTax" required>
                    <!-- Hidden input field to store the calculated taxAmout -->
                    <input type="hidden" id="dueTaxHidden" name="dueTaxHidden"> 
                </div>
            </div>
            <br>
            <br>
            <h3>Penalties</h3>
            <hr class="hr-dashboard">
            <br>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="delayone" class="form-label">Penalty for Delay %5</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">300</span>
                    <input  type="text" class="form-control" id="delayone" name="delayone" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="dalaytwo" class="form-label">Penalty for Delay %10</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">310</span>
                    <input  type="text" class="form-control" id="dalaytwo" name="dalaytwo" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="dalaythree" class="form-label">Penalty for not Submitting the Seasonal Report</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">320</span>
                    <input type="text" class="form-control" id="dalaythree" name="dalaythree" value="0" required>
                </div>
            </div>            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="totaloftaxpen" class="form-label">Total of Taxes and Penalties</label>
                </div>
                <div class="col-md-6 input-group">
                   <span class="input-group-text custom-label" id="basic-addon1">330</span>
                    <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="totaloftaxpen" name="totaloftaxpen" required>
                    <!-- Hidden input field to store the calculated total -->
                    <input type="hidden" id="totalTaxHidden" name="totalTaxHidden"> 
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="delayinterest" class="form-label">Delay Interest</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">340</span>
                    <input  type="text" class="form-control" id="delayinterest" name="delayinterest" required value="0">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="paidamount" class="form-label">Total Amount that needs to be Paid</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">350</span>
                    <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="paidamount" name="paidamount" required>
                     <!-- Hidden input field to store the calculated total -->
                     <input type="hidden" id="paidamountHidden" name="paidamountHidden">   
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="blanace" class="form-label">Balance as a result of paying additional taxes in previous seasons</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">360</span>
                    <input  type="text" class="form-control" id="blanace" name="blanace" value="0" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="remainingbalance" class="form-label">Total Remaining balance</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">370</span>
                    <input  type="text" class="form-control" id="remainingbalance" name="remainingbalance" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="tobepaid" class="form-label">Summary of final Amount to be paid</label>
                </div>
                <div class="col-md-6 input-group">
                    <span class="input-group-text custom-label" id="basic-addon1">380</span>
                    <input readonly style="background-color: #e5f1f6;"  type="text" class="form-control" id="tobepaid" name="tobepaid" required>
                    <!-- Hidden input field to store the calculated total -->
                    <input type="hidden" id="tobepaidhidden" name="tobepaidhidden">  
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-primary prev-step">Previous</button>
            <button type="submit" class="btn btn-success">Submit</button>
           
        </div>
    <form>
    <!-- Modal -->
    <div class="modal fade" id="submissionModal" tabindex="-1" role="dialog" aria-labelledby="submissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submissionModalLabel">Form Submitted Successfully</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your form has been submitted successfully. Below are the details:</p>
                    <p><strong>Form Reference Number:</strong> <span id="formReferenceNumber"></span></p>
                    <p><strong>Date of Submission:</strong> <span id="dateOfSubmission"></span></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" id="downloadFormButton">Download Form</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal"><a href="" id="payButton">Pay</a></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="/taxpayer/dashboard">Close</a></button>
                </div>
            </div>
        </div>
    </div>

    <!--Auto save Modal-->
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!--pop up message-->
<script>
    // Function to show the submission modal with form details
    function showSubmissionModal(formReferenceNumber, dateOfSubmission, paymentId) {
        console.log(paymentId);
        $('#formReferenceNumber').text(formReferenceNumber);
        $('#dateOfSubmission').text(dateOfSubmission);
        $('#payButton').attr('href', '/taxpayer/payments/' + paymentId);
        $('#submissionModal').modal('show');
    }

    $(document).ready(function() {
        // Check if session has success message and call the modal function if true
        @if(session('success'))
            showSubmissionModal('{{ session('formReferenceNumber') }}', '{{ session('dateOfSubmission') }}', '{{ session('paymentId') }}');
        @endif

        // When the download button is clicked, perform necessary action
        $(document).on('click', '#downloadFormButton', function(e) {
            e.preventDefault(); // Prevent default action
            var formReferenceNumber = $('#formReferenceNumber').text(); // Get the form reference number
            // Construct the correct URL for downloading the PDF
            var downloadUrl = '{{ url("/download-pdf") }}/' + formReferenceNumber;
            // Perform download action here
            window.location.href = downloadUrl;
        });
    });
</script>
<!-- Calculations -->
<script>
    $(document).ready(function() {
        var currentStep = 1;
    
    // Hide all steps except the first one initially
    $('#multi-step-form').find('.step').slice(1).hide();

    // Initialize step circles
    updateStepCircles();

    $(".next-step").click(function() {
        if (validateStep(currentStep)) {
            if (currentStep < 3) {
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
        var progressPercentage = ((currentStep - 1) / 3) * 100;
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

    // Automation for Property Year To Date
    var propertyYearFromInput = document.getElementById('propertyyearfrom');
    var propertyYearToInput = document.getElementById('propertuyearto');

    propertyYearFromInput.addEventListener('change', function() {
        var fromDate = new Date(propertyYearFromInput.value);
        if (!isNaN(fromDate.getTime())) {
            var nextYearDate = new Date(fromDate);
            nextYearDate.setFullYear(fromDate.getFullYear() + 1);
            nextYearDate.setDate(nextYearDate.getDate() - 1); // Subtract one day to get the same date next year
            propertyYearToInput.value = nextYearDate.toISOString().split('T')[0];
        } else {
            propertyYearToInput.value = ''; // Clear the value if the input is not a valid date
        }
    });

    const quarterSelect = document.getElementById('quarter');
    const fromDateInput = document.getElementById('seasonfromDate');
    const toDateInput = document.getElementById('seasontoDate');

    function updateQuarterDates() {
        const selectedQuarter = quarterSelect.value;
        const year = new Date().getFullYear();
        let fromDate, toDate;

        switch (selectedQuarter) {
            case 'Q1':
                fromDate = new Date(year, 0, 1); // January 1
                toDate = new Date(year, 2, 31); // March 31
                break;
            case 'Q2':
                fromDate = new Date(year, 3, 1); // April 1
                toDate = new Date(year, 5, 30); // June 30
                break;
            case 'Q3':
                fromDate = new Date(year, 6, 1); // July 1
                toDate = new Date(year, 8, 30); // September 30
                break;
            case 'Q4':
                fromDate = new Date(year, 9, 1); // October 1
                toDate = new Date(year, 11, 31); // December 31
                break;
            default:
                fromDate = null;
                toDate = null;
        }

        if (fromDate && toDate) {
            fromDateInput.value = formatDate(fromDate);
            toDateInput.value = formatDate(toDate);
        }
    }

    quarterSelect.addEventListener('change', updateQuarterDates);

    // Call updateQuarterDates initially to set the dates based on the default selected quarter
    updateQuarterDates();

    // Function to format date as YYYY-MM-DD
    function formatDate(date) {
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Calculation Functions
    function getNumericValue(inputElement) {
        return parseFloat(inputElement.value.replace(/,/g, '')) || 0;
    }

    function updateTotal() {
        const salaryandwages = getNumericValue(document.getElementById('salaryandwages'));
        const Allowancess = getNumericValue(document.getElementById('Allowancess'));
        const bonus = getNumericValue(document.getElementById('bonus'));
        const total = salaryandwages + Allowancess + bonus;
        const totalInput = document.getElementById('total');
        const totalHiddenInput = document.getElementById('totalHidden');
        totalInput.value = total.toFixed(2);
        totalHiddenInput.value = total.toFixed(2);
    }

    function updateSummary() {
        const total = getNumericValue(document.getElementById('total'));
        const retire = getNumericValue(document.getElementById('retire'));
        const Gallowances = getNumericValue(document.getElementById('Gallowances'));
        const summary = total - retire - Gallowances;
        const summaryInput = document.getElementById('summary');
        const summaryhiddenInput = document.getElementById('summeryHidden');
        summaryInput.value = summary.toFixed(2);
        summaryhiddenInput.value = summary.toFixed(2);
    }

    function updateTaxAmount() {
        const summary = getNumericValue(document.getElementById('summary'));
        const examptions = getNumericValue(document.getElementById('examptions'));
        const taxAmount = summary - examptions;
        const taxAmountInput = document.getElementById('taxAmount');
        const taxAmountHiddenInput = document.getElementById('taxAmountHidden');
        taxAmountInput.value = taxAmount.toFixed(2);
        taxAmountHiddenInput.value = taxAmount.toFixed(2);
    }

    function updateDueTax() {
        const taxAmount = getNumericValue(document.getElementById('taxAmount'));
        const dueTax = taxAmount * 0.05;
        const dueTaxInput = document.getElementById('dueTax');
        const dueTaxHiddenInput = document.getElementById('dueTaxHidden');
        dueTaxInput.value = dueTax.toFixed(2);
        dueTaxHiddenInput.value = dueTax.toFixed(2);
    }
      // Function to calculate penalties based on last submission form session date
    function calculatePenaltyfive() {
        const delayOneInput = document.getElementById('delayone');
        const dueTaxElement = document.getElementById('dueTax');
        console.log("dueTaxElement.value in calculatePenaltyfive:", dueTaxElement.value);
        const dueTaxValue = parseFloat(dueTaxElement.value);
        const penalty = (dueTaxValue * 0.05).toFixed(2);
        delayOneInput.value = penalty;
    }

    // Function to calculate penalties based on last submission form session date
    function calculatePenaltyten() {
        const delayTwoInput = document.getElementById('dalaytwo');
        const dueTaxElement = document.getElementById('dueTax');
        console.log("dueTaxElement.value in calculatePenaltyten:", dueTaxElement.value);
        const dueTaxValueten = parseFloat(dueTaxElement.value);
        const penalty = (dueTaxValueten * 0.10).toFixed(2);
        delayTwoInput.value = penalty;
    }


    function updateTotalTaxPenalty() {
        const dueTax = parseFloat(document.getElementById('dueTax').value) || 0;
        const delayOne = parseFloat(document.getElementById('delayone').value) || 0;
        const delayTwo = parseFloat(document.getElementById('dalaytwo').value) || 0;
        const delayThree = parseFloat(document.getElementById('dalaythree').value) || 0;
        const totalofTaxpenenaltyInput = document.getElementById('totaloftaxpen');
        const totalofTaxpenenaltyHiddenInput = document.getElementById('totalTaxHidden');
        const totalTaxPenalty = dueTax + delayOne + delayTwo + delayThree;
        totalofTaxpenenaltyInput.value = totalTaxPenalty.toFixed(2);
        totalofTaxpenenaltyHiddenInput.value = totalTaxPenalty.toFixed(2);
    }

    function updatePaidAmount() {
        const totalTaxPenalty = parseFloat(document.getElementById('totaloftaxpen').value) || 0;
        const delayinterest = parseFloat(document.getElementById('delayinterest').value) || 0;
        const paidamountInput = document.getElementById('paidamount');
        const paidamountHiddenInput = document.getElementById('paidamountHidden');
        const TotalPaidAmount = totalTaxPenalty + delayinterest;
        paidamountInput.value = TotalPaidAmount.toFixed(2);
        paidamountHiddenInput.value = TotalPaidAmount.toFixed(2);
    }

    function updateRemainingBalance() {
        const paidamount = parseFloat(document.getElementById('paidamount').value) || 0;
        const blanace = parseFloat(document.getElementById('blanace').value) || 0;
        const remainingbalanceInput = document.getElementById('remainingbalance');
        let remainingbalance = paidamount - blanace;
        // If remainingbalance is less than zero, set it to the absolute value
        remainingbalance = Math.max(0, remainingbalance);
        remainingbalanceInput.value = remainingbalance.toFixed(2);
    }

    function summaryTobePaid() {
        const remainingbalanceInput = parseFloat(document.getElementById('remainingbalance').value) || 0;
        const tobePaidInput = document.getElementById('tobepaid');
        tobePaidInput.value = remainingbalanceInput.toFixed(2);
    }

     // Function to calculate penalties based on last submission form session date
     function calculatePenalties() {
        // Perform AJAX request to fetch last submission form session date
        $.ajax({
            url: '/api/getLastSubmissionDate', // Replace with actual endpoint
            method: 'GET',
            success: function(response) {
                // Parse response JSON
                var lastSubmissionDate = new Date(response.lastSubmissionDate);
                console.log(lastSubmissionDate);
                var currentDate = new Date();

                // Calculate days difference
                var daysDifference = Math.floor((currentDate - lastSubmissionDate) / (1000 * 60 * 60 * 24));
                console.log(daysDifference);

                // Check if new form is 20 days after the sessiontodate
                if (daysDifference >= 50) {
                    // Calculate penalties and update input fields
                    calculatePenaltyfive();
                    calculatePenaltyten();
                } else if (daysDifference >= 20) {
                    calculatePenaltyfive();
                    $('#dalaytwo').val(0);
                } else {
                    // Set all values to zero
                    $('#delayone').val(0);
                    $('#dalaytwo').val(0);
                }

                // After calculating penalties, update other fields
                updateTotal();
                updateSummary();
                updateTaxAmount();
                updateDueTax();
                updateTotalTaxPenalty();
                updatePaidAmount();
                updateRemainingBalance();
                summaryTobePaid();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error
            }
        });
    }
        $(document).ready(function() {
            // Call calculatePenalties function when the page loads
            calculatePenalties();
        });

    // Event listeners for input fields
    const inputs = ['salaryandwages', 'Allowancess', 'bonus', 'retire',
    'Gallowances', 'examptions','dueTax','delayone','dalaytwo','dalaythree','delayinterest','blanace'];
    inputs.forEach(id => {
        const inputElement = document.getElementById(id);
        if (inputElement) {
            inputElement.addEventListener('input', function() {
                updateTotal();
                updateSummary();
                updateTaxAmount();
                updateDueTax();
                //calculatePenaltyfive();
               // calculatePenaltyten();
                updateTotalTaxPenalty();
                updatePaidAmount();
                updateRemainingBalance();
                summaryTobePaid();
                calculatePenalties();
            });
        }
    });

        // Initial calculations
        updateTotal();
        updateSummary();
        updateTaxAmount();
        updateDueTax();
        // calculatePenaltyfive();
        // calculatePenaltyten();
        updateTotalTaxPenalty();
        updatePaidAmount();
        updateRemainingBalance();
        summaryTobePaid();

    });

</script>
<!--Quarter check-->
<script>
    $(document).ready(function() {
        $('#quarter').change(function() {
            var selectedQuarter = $(this).val();

            // AJAX request to check if the user has already applied for the selected quarter
            $.ajax({
                url: '{{ route("checkQuarterAvailability") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quarter: selectedQuarter
                },
                success: function(response) {
                    if (response.exists) {
                        $('#quarterError').text('You have already submitted a form for this quarter.').show();
                    } else {
                        $('#quarterError').hide();
                    }
                }
            });
        });
    });
</script>
<!--Representattive-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var repTypeYes = document.getElementById('repTypeYes');
        var repTypeNo = document.getElementById('repTypeNo');
        var repFields = document.querySelectorAll('.rep-fields');

        function toggleRepFields() {
            if (repTypeYes.checked) {
                repFields.forEach(function(field) {
                    field.style.display = 'flex';
                });
            } else {
                repFields.forEach(function(field) {
                    field.style.display = 'none';
                });
            }
        }

        repTypeYes.addEventListener('change', toggleRepFields);
        repTypeNo.addEventListener('change', toggleRepFields);

        // Initially check the radio button state to toggle representative fields
        toggleRepFields();
    });
</script>

<!--penalty calculation-->
<script>
    
</script>





@endsection





