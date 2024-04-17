<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/favicon.png') }}" style="width: 150px !important; height:50px !important;" alt="">
        </a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
          <li><a class="nav-link" href="{{ route('all.doctors') }}">Doctors</a></li>
          <li><a class="nav-link" href="{{ route('all.traffic.posts') }}">Traffic Posts</a></li>
          <li><a class="nav-link" href="{{ route('all.medical.posts') }}">Medical Posts</a></li>
          <li class="dropdown"><a href="#"><span>Health Centers</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                @if(!empty(\App\Helpers\Helper::fetchHealthCareCenters()))
                    @foreach (\App\Helpers\Helper::fetchHealthCareCenters() as $center)
                        <li><a href="{{ route('center', $center->id) }}">{{ $center->name }}</a></li>
                    @endforeach
                @endif
            </ul>
          </li>
          <li><a class="nav-link" href="{{ route('contact-us') }}">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="{{ route('login') }}" class="appointment-btn scrollto"><span class="d-none d-md-inline">Login</span></a>

    </div>
  </header><!-- End Header -->
