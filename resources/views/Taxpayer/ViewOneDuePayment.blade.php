@extends('Taxpayer.Layouts.layout')

@section('ViewOneDuePayment')
<br>
<div class="d-flex justify-content-between align-items-center mb-5">
    <div class="d-flex flex-row align-items-center">
        <br>
        <h4 class="text-uppercase mt-1">Payment</h4>
        <span class="ms-2 me-3">Info</span>
    </div>
    <a href="{{route('tp.dashboard')}}">return to the Home page</a>
</div>

<div class="row">
    <div class="col-md-7 col-lg-7 col-xl-6 mb-4 mb-md-0">
        <h5 class="mb-0 text-color"> Due Tax IQD {{ $payment->dueTax }}</h5>
        <br>
        <h5 class="mb-3">This Payment Belongs to&nbsp;({{ $payment->form_reference }}) &nbsp;PIT Form</h5>
        <div>
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-row mt-1">
                    <h6>Other Fields if needed</h6>
                    <h6 class="fw-bold text-color ms-1">$71.76</h6>
                </div>
            </div>
            <p>
                This payment is valid for one month only. If the payment is not made within this period, penalties will be applied.
            </p>
            <div class="p-2 d-flex justify-content-between align-items-center bg-body-tertiary">
                <span class="text-success">Form submitted at - {{ $payment->submission_date }}</span>
                <span class="text-danger">Due Date - {{ $payment->payment_deadline }}</span>
            </div>
            <hr />
            <h4 class="mt-1">Payment Methods</h4>
            <!-- Payment options dropdown -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="mb-3 h-100">
                        <!-- Dropdown for selecting payment method -->
                        <select class="form-select mb-3" id="paymentMethod">
                            <option value="">Choose Payment Method</option>
                            <option value="fib">FIB Credit/Debit Card</option>
                            <option value="bank">Bank Transfer</option>
                            <option value="qr">QR Code</option>
                        </select>
                        <!-- Placeholder for dynamic content -->
                        <div id="paymentContent">
                            <!-- Card payment form -->
                            <div id="cardPaymentForm" style="display: none;">
                                <div class="card mb-3 h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Enter Card Information</h5>
                                        <form id="cardForm">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="cardNumber">Name on card</label>
                                                    <input type="text" class="form-control" id="cardName" required>
                                                    <small class="text-muted">Full name as displayed on card</small>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="cc-number">Credit card number</label>
                                                    <input type="text" class="form-control" id="cc-number" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="cc-expiration">Expiration</label>
                                                    <input type="text" class="form-control" id="cc-expiration" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="cc-cvv">CVV</label>
                                                    <input type="text" class="form-control" id="cc-cvv" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank transfer content -->
                            <div id="bankTransferContent" style="display: none;">
                                <div class="card mb-3 h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Bank Transfer</h5>
                                        <p>Make payment to the following bank account:</p>
                                        <p>Bank: [Bank Name]</p>
                                        <p>Account Number: [Account Number]</p>
                                    </div>
                                </div>
                            </div>

                            <!-- QR code content -->
                            <div id="qrCodePrintArea">
                                <h5 class="card-title">QR Code</h5>
                                <img id="qrCodeImage" src="" alt="QR Code" class="img-fluid">
                                <button class="btn btn-secondary mt-3" id="printQrCode">Print QR Code</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var paymentMethodSelect = document.getElementById('paymentMethod');
    var cardPaymentForm = document.getElementById('cardPaymentForm');
    var bankTransferContent = document.getElementById('bankTransferContent');
    var qrCodeContent = document.getElementById('qrCodePrintArea');
    var qrCodeImage = document.getElementById('qrCodeImage');
    var printQrCodeButton = document.getElementById('printQrCode');

    function displayPaymentContent(paymentMethod) {
        if (!cardPaymentForm || !bankTransferContent || !qrCodeContent) return; // Error handling

        cardPaymentForm.style.display = 'none';
        bankTransferContent.style.display = 'none';
        qrCodeContent.style.display = 'none';

        if (paymentMethod === 'fib') {
            cardPaymentForm.style.display = 'block';
        } else if (paymentMethod === 'bank') {
            bankTransferContent.style.display = 'block';
        } else if (paymentMethod === 'qr') {
            qrCodeContent.style.display = 'block';
            generateQRCode();
        }
    }

    if (paymentMethodSelect) {
        paymentMethodSelect.addEventListener('change', function() {
            var selectedMethod = this.value;
            displayPaymentContent(selectedMethod);
        });

        displayPaymentContent(paymentMethodSelect.value);
    }

    // Function to generate QR code
    function generateQRCode() {
        if (!qrCodeImage) return; // Error handling

        var formReference = '{{ $payment->form_reference }}';
        var qrCodeImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' + formReference + '&size=200x200';
        qrCodeImage.src = qrCodeImageUrl;
    }

    // Event listener for print button
    if (printQrCodeButton) {
        printQrCodeButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default print behavior

            var printContents = qrCodeContent.innerHTML; // Changed to qrCodeContent
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        });
    }

    // Generate QR code initially
    generateQRCode();
});

</script>


@endsection

