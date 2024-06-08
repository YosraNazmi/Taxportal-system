@extends('Layouts')

@section('Welcome')
<section id="hero">
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active" style="background-image: url({{asset('img/erbil.jpg')}})">
        <div class="carousel-container">
        <div class="container">
          <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Tax Organisation</span></h2>
          <br><br>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit">Search</button>
          </form>
        </div>
       </div>
      </div>
    </div>
  </section>

<main id="main">
    <section id="feature-services" class="featured-services section-bg">
      <div class="container">

        <div class="row no-gutters">
          <div class="col-lg-4 col-md-6">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-bank"></i></div>
              <h4 class="title"><a href="/Pit">PIT</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-briefcase"></i></div>
              <h4 class="title"><a href="">Annual Tax</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-calendar4-week"></i></div>
              <h4 class="title"><a href="">With holding Tax</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur trade stravi</p>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>

@endsection