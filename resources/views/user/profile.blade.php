@extends('landing')

@section('style')
    <!-- Custom styles for this template -->
    <link href="{{ url('/') }}/css/scrolling-nav.css" rel="stylesheet">
@endsection

@section('title', 'Profile')

@section('content')
<section id="about" style="width: 75%; margin-left: auto; margin-right: auto;">
    <h2 style="text-align: center;">{{ Auth::user()->id }} Profile</h2>
    <div class="col-lg-12">
        <p>
            </p>
            <div class="row">
                <div class="col-lg-12">
                <div class="row form-group"><div class="col-sm-2">VATSIM ID</div><div class="col-sm-10"><input type="text" value="{{ Auth::user()->id }}" name="name" class="form-control" disabled=""></div></div>
                <div class="row form-group"><div class="col-sm-2">Name</div><div class="col-sm-10"><input type="text" value="{{ Auth::user()->fname }} {{ Auth::user()->lname }}" name="name" class="form-control" disabled=""><small class="form-text">To change your name, please contact <a href="https://membership.vatsim.net/" target="_blank">VATSIM Membership</a>.</small></div></div>
                <div class="row form-group"><div class="col-sm-2">Email</div><div class="col-sm-10"><input type="text" value="{{ Auth::user()->email }}" name="name" class="form-control" disabled=""><small class="form-text">To change your email, please contact <a href="https://membership.vatsim.net/" target="_blank">VATSIM Membership</a>.</small></div></div>
                </div>
            </div>
      </div>
      <p></p>
      <h2 style="text-align: center;">All your bookings</h2>
<table class="table" style="width:100%; word-break: break-all; text-align: center;">
    <thead>
        <tr>
            <th>Callsign</th>
            <th>Aircraft</th>
            <th>DEP ICAO</th>
            <th>ARR ICAO</th>
            <th>STD</th>
            <th>STA</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->callsign }}</td>
            <td>{{ $booking->aircraft }}</td>
            <td>{{ $booking->dep_icao }}</td>
            <td>{{ $booking->arr_icao }}</td>
            <td>
                @if ($booking->etd == null || $booking->etd == '')
                -
                @else
                {{ substr($booking->etd, 11, 16) }}
                @endif
            </td>
            <td>
                @if ($booking->eta == null || $booking->eta == '')
                -
                @else
                {{ substr($booking->eta, 11, 16) }}
                @endif
            </td>
            <td><a href="{{ route('user.booking', $booking->unique_id) }}"><button class="btn btn-primary">View Details</button></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
</section>
@endsection
