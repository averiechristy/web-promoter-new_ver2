  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span>

        <a class="nav-link scrollto" href="{{route('user.home')}}"><img src="{{asset('img/logoexa.png')}}" alt=""  class="logo"></a>
        </span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li ><a class="nav-link scrollto" href="{{route('user.home')}}">Home</a></li> -->
          <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Income
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      <li><a class="dropdown-item" href="{{route ('user.kalkulator')}}">Hitung Sendiri</a></li>
      
      <li><a class="dropdown-item" href="{{route ('user.package')}}">Lihat Paket Tersedia</a></li>
     
    </ul>
  </li>          <li><a class="nav-link scrollto" href="{{route('user.artikel')}}">Article</a></li>
          <li><a class="nav-link scrollto" href="{{route('user.contact')}}">Contact Us</a></li>
          
          <li> <a class="nav-link" href=""><span class="ml-8 d-none d-lg-inline text-gray-600 small">Welcome,  {{ Auth::user()->nama }}!</span></a></li>


        <li class="dropdown">
    <a href="#">
    @if(auth()->check() && auth()->user()->avatar)
    <span> <img src="{{ asset('img/' . auth()->user()->avatar) }}"  class="user"></span>
@else
<span> <img src="{{ asset('img/default.jpg') }}"  class="user"> </span>
@endif


        <i class="bi bi-chevron-down"></i>
    </a>
    <ul>
        <li><a href="#" data-toggle="modal" data-target="#changeProfilePhotoModal">Change Profile Photo</a></li>
        <li><a href="{{ route('edit-profile') }}">Edit Profile</a></li>
        <li><a href="{{ route('password-change-user') }}">Change Password</a></li>
        <li>
            <a href="#" data-toggle="modal" data-target="#logoutModal">
                Logout
            </a>
        </li>
    </ul>
</li>

          
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->