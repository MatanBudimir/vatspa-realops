@extends('landing')

@section('title', 'Bookings')

@section('content')
<section id="about" style="width: 75%; margin-left: auto; margin-right: auto;">
    <h2 style="text-align: center;">All Bookings</h2>

<table id="usersTable" class="table" style="width:100%; word-break: break-all; text-align: center;">
    <thead>
        <tr>
            <th>Callsign</th>
            <th>Pilot ID</th>
            <th>Aircraft</th>
            <th>ETD</th>
            <th>ETA</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->callsign }}</td>
            <td>{{ $booking->user_id }}</td>
            <td>{{ $booking->aircraft }}</td>
            <td>{{ $booking->etd }}</td>
            <td>{{ $booking->eta }}</td>
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
    $('#usersTable').DataTable();
} );
</script>
@endsection
