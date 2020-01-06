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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('bookings*', 'booking*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Bookings
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @auth
              @if (App\Models\Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() < App\Models\EventInfo::first()->allowed_bookings)
              <a class="dropdown-item {{ Request::is('bookings/departures') ? 'active' : '' }}" href="{{ route('bookings.dep') }}">Departures</a>
              <a class="dropdown-item {{ Request::is('bookings/arrivals') ? 'active' : '' }}" href="{{ route('bookings.arr') }}">Arrivals</a>
              @endif
              @else
              <a class="dropdown-item {{ Request::is('bookings/departures') ? 'active' : '' }}" href="{{ route('bookings.dep') }}">Departures</a>
              <a class="dropdown-item {{ Request::is('bookings/arrivals') ? 'active' : '' }}" href="{{ route('bookings.arr') }}">Arrivals</a>
              @endauth
              @auth
              @hasBooking
              @if (App\Models\Booking::where('user_id', Auth::user()->id)->where('booked', true)->count() < App\Models\EventInfo::first()->allowed_bookings)
              <div class="dropdown-divider"></div>
              @endif
              @foreach (App\Models\Booking::where('user_id', Auth::user()->id)->where('booked', true)->get() as $booking)
              <a class="dropdown-item {{ Request::is('booking') ? 'active' : '' }}" href="{{ route('user.booking', $booking->unique_id) }}">{{ $booking->callsign }}</a>
              @endforeach
              @endhasBooking
              @endauth
            </div>
          </li>
          @auth
          @admin
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('admin*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Admin
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
                <a class="dropdown-item {{ Request::is('admin/bookings') ? 'active' : '' }}" href="{{ route('admin.bookings') }}">Bookings</a>
                <a class="dropdown-item {{ Request::is('admin/event') ? 'active' : '' }}" href="{{ route('admin.event') }}">Edit Event</a>
            </div>
          </li>
          @endadmin
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('profile') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->fname }} {{ Auth::user()->lname }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item {{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a>
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
      <p class="m-0 text-center text-white">Copyright &copy; {{ date('Y') }} <a href="https://vatspa.es" target="_blank" style="color: white;">VatSpa - vACC España - Spain</a>. Todos los derechos reservados</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ url('/') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ url('/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- Plugin JavaScript -->
  <script src="{{ url('/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  @if (session()->has("success"))
            <script lang="javascript">
                Swal.fire(
                    'Success!',
                    "{{ session('success') }}",
                    'success'
                )
            </script>
        @endif

        @if (session()->has("error"))
            <script lang="javascript">
                Swal.fire(
                    'Error!',
                    "{{ session('error') }}",
                    'error'
                )
            </script>
        @endif

  @yield('scripts')

</body>


</html>
