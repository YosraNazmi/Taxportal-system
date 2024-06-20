<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<title>Taxpayer Account Registration</title>
<body>
    <section id="register">
        <div class="container login-secc" style="max-width: 1000px">
            <h2 class="text-center">Create your Tax Portal Account</h2>
            <br>
            <div class="mt-5">
                @if ($errors->any())
                <div class="col-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                </div>
                @endif
                @if (session()->has ('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                @if (session()->has ('success'))
                <div class="alert alert-success">{{session('success')}}</div>
                @endif
            </div>
            <form action="{{ route('register.post') }}" method="POST">
                @csrf <!-- CSRF protection -->
                <div class="row">
                    <legend>Personal Information Details</legend>
                    <div class="col-md-6">
                        <!-- First Name Input -->
                        <input type="text" class="form-control" placeholder="First name" name="firstname" value="{{ old('firstname') }}">
                    </div>
                    <div class="col-md-6">
                        <!-- Last Name Input -->
                        <input type="text" class="form-control" placeholder="Last name" name="lastname" value="{{ old('lastname') }}">
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <!-- UEN Name Input -->
                        <input type="text" class="form-control" placeholder="UPN Number" name="UPN" value="{{ old('uen') }}">
                    </div>
                    <div class="col">
                        <!-- Date of Birth Input -->
                        <input type="date" placeholder="Date Of Birth" class="form-control" name="dob" value="{{ old('dob') }}">
                    </div>
                </div>
                <br>
                <div class="row">
                   
                    <div class="col">
                        <!-- ID Type Select Dropdown -->
                        <select class="form-control" name="select">
                            <option value="passport" >Passport</option>
                            <option value="nationalId" >National ID</option>
                        </select>
                    </div>
                    <div class="col">
                        <!-- ID Number Input -->
                        <input type="text" class="form-control" placeholder="National ID No" name="idNo" value="{{ old('idNo') }}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <legend>Company Information</legend>              
                    <div class="col-sm-4">
                        <!-- Phone Number Input -->
                        <input type="text" name="companyName" placeholder="Company Name" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <!-- Password Input -->
                        <input type="text" name="uen" placeholder="UEN Number" class="form-control">
                    </div>
                    <div class="col">
                        <!-- ID Type Select Dropdown -->
                        <select class="form-control" name="category" aria-placeholder="Company Type">
                            <option value="Bank" >Bank</option>
                            <option value="Government" >Givernmanrt</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <legend>Address Details</legend>
                    <div class="col">
                        <!-- Address Line 1 Input -->
                        <input type="text" name="addressLine1" placeholder="Address Line 1" class="form-control" value="{{ old('addressLine1') }}">
                    </div>
                    <div class="col">
                        <!-- City Input -->
                        <input type="text" name="city" placeholder="City" class="form-control" value="{{ old('city') }}">
                    </div>
                    <div class="col">
                        <!-- Country Input -->
                        <input type="text" name="country" placeholder="Country" class="form-control" value="{{ old('country') }}">
                    </div>
                    <div class="col">
                        <!-- Postal Code Input -->
                        <input type="text" name="postalCode" placeholder="Post Code" class="form-control" value="{{ old('postalCode') }}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <legend>Contact Information</legend>              
                    <div class="col-sm-3">
                        <!-- Phone Number Input -->
                        <input type="text" name="ePhoneNbr" placeholder="Phone Number" class="form-control" value="{{ old('ePhoneNbr') }}">
                    </div>
                    <div class="col-sm-3">
                        <!-- Email Input -->
                        <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('eEmail') }}">
                    </div>
                    <div class="col-sm-3">
                        <!-- BRS code Input -->
                        <input type="text" name="code" placeholder="Code" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <!-- Password Input -->
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <br><br>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <button href="" class="btn btnn mr-2">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>    
</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</html>