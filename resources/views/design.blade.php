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
<style>
     .container{
        max-width: 900px;
       
    }
</style>
<body>
    <section id="register">
        <div class="container login-secc">
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
                    <div class="col">
                        <!-- First Name Input -->
                        <input type="text" class="form-control mb-3" placeholder="First name" name="firstname" value="{{ old('firstname') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- Last Name Input -->
                        <input type="text" class="form-control mb-3" placeholder="Last name" name="lastname" value="{{ old('lastname') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- UEN Name Input -->
                        <input type="text" class="form-control mb-3" placeholder="UPN Number" name="UPN" value="{{ old('uen') }}">
                    </div>
                </div>
                <!-- Other fields omitted for brevity -->
                <div class="row">
                    <div class="col">
                        <!-- Password Input -->
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3">
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
