@extends('landing')

@section('title', 'Departures')

@section('content')
<section id="about" style="width: 75%; margin-left: auto; margin-right: auto;">
    <h2 style="text-align: center;">All
        @if (Request::is('bookings/departures'))
        Departure
        @else
        Arrival
        @endif
        Slots</h2>
<table id="bookingsTable" class="table" style="width:100%; word-break: break-all; text-align: center;">
    <thead>
        <tr>
            <th>Callsign</th>
            <th>DEP ICAO</th>
            <th>ARR ICAO</th>
            @if (Request::is('bookings/departures'))
            <th>ETD</th>
            @else
            <th>ETA</th>
            @endif
            <th>Book</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($slots as $slot)
        <tr>
            <td>{{ $slot->callsign }}</td>
            <td>{{ $slot->dep_icao }}</td>
            <td>{{ $slot->arr_icao }}</td>
            @if (Request::is('bookings/departures'))
            <td>{{ substr($slot->etd, 11, 16) }}</td>
            @else
            <td>{{ substr($slot->eta, 11, 16) }}</td>
            @endif
            <td>
                @if ($slot->user_id == Auth::user()->id)
                <a href="{{ route('user.booking', $slot->unique_id) }}"><button class="btn btn-primary">View Details</button></a>
                @elseif ($slot->booked)
                <button class="btn btn-danger">Booked</button>
                @else
                <a href="{{ route('user.start.booking', $slot->unique_id) }}"><button class="btn btn-success">Book</button></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</section>
@endsection

@section('scripts')
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script>
$(document).ready( function () {
    $('#bookingsTable').DataTable();
} );
</script>
@endsection
