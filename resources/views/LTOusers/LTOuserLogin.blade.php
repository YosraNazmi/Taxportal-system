<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LTO Login</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
</head>
<body>
    <div class="container admin-containter" style="margin-top: 10%">
        <div class="row justify-content-center color">
        
          <div class="col-xl-5 col-md-8">
            <div class="card shadow">
                <h2 class="text-center" style="margin-top: 10%">Login Now</h2>
                <form action="{{ route('ltouser.login.post') }}" method="POST" class="rounded shadow-5-strong p-5">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <!-- Email input -->
                    <div class="form-outline mb-4" >
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" id="email" class="form-control" name="email" />
                    </div>
                
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password" />
                    </div>
                
                    <!-- Checkbox and forgot password link -->
                    <div class="row mb-4">
                        <div class="col text-center">
                            <!-- Forgot password link -->
                            <a href="#!">Forgot password?</a>
                        </div>
                    </div>
                
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block" data-mdb-ripple-init>Sign in</button>
                </form>                
          </div>
        </div>
        </div>
      </div>
</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</html>