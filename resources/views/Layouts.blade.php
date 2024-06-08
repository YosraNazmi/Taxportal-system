<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Tax Home Portal</title>
</head>
<body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center">
    
          <h1 class="logo me-auto"><a href="home.blade.php">Tax</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
              <li><a class="nav-link scrollto" href="/about">About</a></li>
              <li><a class="nav-link scrollto" href="/services">Services</a></li>
              <li><a class="nav-link scrollto" href="/contact">Contact</a></li>
              <li><a class="nav-link scrollto" href="/login" target="_blank">Login</a></li>
              <li><a class="nav-link scrollto" href="/register" target="_blank">Sign up</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
    
        </div>
    </header><!-- End Header -->

    <!-- Page Content -->
    <div class="">
        @yield('Welcome')
    </div>

    <!--  Footer -->
    <footer id="footer">
        <div class="container">
          <h3>Tax</h3>
          <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
          <div class="social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
          <div class="copyright">
            &copy; Copyright <strong><span>Tax</span></strong>. All Rights Reserved
          </div>
        </div>
      </footer>

</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
</html>