<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  
    <title>Taxpayer Login</title>
</head>
<body>
    <section id="login">
        <div class="row">
            <div class="col-md-4">
                <div class="left-content">
                    
                </div>      
            </div>
            <div class="col-md-8 login-sec">
                <div class="container">
                    <h2 class="text-center">Login Now</h2>
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
                    <form action="{{route('login.post')}}" method="POST" class="login100-form validate-form">
                        @csrf
                        <div class="wrap-input100 validate-input">
                            <span class="label-input100">Email</span>
                            <input type="email" name="email" placeholder="Type your Email" class="input100" value="{{ old('eEmail') }}">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <span class="label-input100">Password</span>
                            <input type="password" name="password" placeholder="Type your password" class="input100">
                            <span class="focus-input100 password"></span>
                        </div>
                        <div class="text-right p-t-8 p-b-31">
                            <a href="#">
                                Forgot password?
                            </a>
                        </div>
                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <button class="btn btnn mr-2">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>
</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</html>