@extends('landing')

@section('style')
    <!-- Custom styles for this template -->
    <link href="{{ url('/') }}/css/scrolling-nav.css" rel="stylesheet">
@endsection

@section('title', 'Bookings')

@section('content')
<section id="about" style="width: 75%; margin-left: auto; margin-right: auto;">
    <h2 style="text-align: center;">All Bookings</h2>
    <!-- Button trigger modal -->
<center><button type="button" style="margin-bottom: 10px;" class="btn btn-primary" data-toggle="modal" data-target="#importModal">
    Import Flights
  </button></center>
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

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Flights</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.import.flights') }}" enctype="multipart/form-data">
                @csrf
          <input class="form-control" type="file" name="xlsx">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-success">Import Flights</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection
