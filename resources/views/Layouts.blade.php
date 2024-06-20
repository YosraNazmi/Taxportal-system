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
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo me-auto"><a href="{{route('welcome')}}">Tax</a></h1>
        
        <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light bg-white">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class=" navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link scrollto" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link scrollto" href="/services">Services</a></li>
                    <li class="nav-item"><a class="nav-link scrollto" href="/contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link scrollto" href="/login" target="_blank">Login</a></li>
                    <li class="nav-item"><a class="nav-link scrollto" href="/register" target="_blank">Sign up</a></li>
                </ul>
            </div>
        </nav>
          
      </div>
  </header>



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
<script>
 document.addEventListener("DOMContentLoaded", function() {
    const mobileNavToggle = document.getElementById('mobile-nav-toggle');
    const navbar = document.getElementById('navbar');

    console.log("JavaScript loaded."); // Debugging statement

    mobileNavToggle.addEventListener('click', function() {
        navbar.classList.toggle('active');
        console.log("Toggle button clicked."); // Debugging statement
    });
});
</script>
</html>