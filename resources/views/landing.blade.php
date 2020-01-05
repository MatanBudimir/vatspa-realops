<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ App\Models\EventInfo::first()->event_name }} | @yield('title')</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ url('/') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ url('/') }}/css/scrolling-nav.css" rel="stylesheet">

  <!-- VATSPA Favicon -->
  <link rel="shortcut icon" href="https://vatspa.es/favicon.ico">

  @yield('style')

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><img src="https://vatspa.es/img/VATSPA_LOGO.png"  width="10%"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('bookings*') ? 'active' : '' }}" href="{{ route('bookking.index') }}">Bookings</a>
          </li>
          @auth
          @admin
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('admin*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.users') }}">Users</a>
                <a class="dropdown-item" href="{{ route('admin.bookings') }}">Bookings</a>
                <a class="dropdown-item" href="{{ route('admin.event') }}">Edit Event</a>
            </div>
          </li>
          @endadmin
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('profile') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->fname }} {{ Auth::user()->lname }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>



  @yield('content')

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; {{ date('Y') }} 2020 <a href="https://vatspa.es" target="_blank" style="color: white;">VatSpa - vACC España - Spain</a>. Todos los derechos reservados</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ url('/') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ url('/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="{{ url('/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

  @yield('scripts')

</body>


</html>
