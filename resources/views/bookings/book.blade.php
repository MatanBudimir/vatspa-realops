@extends('landing')

@section('title', 'Book')

@section('style')
    <style>
        td {
            width: 50%;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ url('/') }}/css/scrolling-nav.css" rel="stylesheet">
@endsection

@section('content')
<section id="about" style="width: 75%; margin-left: auto; margin-right: auto;">
    <h2 style="text-align: center;">All
        @if (Request::is('bookings/departures'))
        Departure
        @else
        Arrival
        @endif
        Slots</h2>
        <center class="col-lg-12">
            <center><form action="{{ route('user.book.slot') }}" method="POST">
                @csrf
                <input hidden value="{{ $slot->unique_id }}" name="uid">
                <p></p><b>Please enter the flight details in the boxes below.</b><br><br>
                    <center><table class="table align-center-custom" style="text-align: center;" width="100%">

                        <tbody><tr><td><b>Callsign </b><font size="2">(e.g. DLH123)</font></td>
                            <td>
                                {{ $slot->callsign }}
                            </td>
                        </tr>
                        <tr>
                            <td><b>Departure Airport</b></td>
                            <td>{{ $slot->dep_icao }}</td>
                        </tr>
                        <tr>
                            <td><b>Arrival Airport</b></td>
                            <td>{{ $slot->arr_icao }}</td>
                        </tr>
                        @if ($slot->etd != null || $slot->etd != '')
                        <tr>
                            <td><b>Estimated Time of Depature </b><font size="2">(ETD)</font></td>
                            <td>{{ substr($slot->etd, 11, 16) }}</td>
                        </tr>
                        @endif
                        @if ($slot->eta != null || $slot->eta != '')
                        <tr>
                            <td><b>Estimated Time of Arrival </b><font size="2">(ETA)</font></td>
                            <td>{{ substr($slot->eta, 11, 16) }}</td>
                        </tr>
                        @endif
                        <tr><td><b>Aircraft </b><font size="2">(e.g. A320, B738, A332, ...)</font></td>
                            <td>
                                <input class="form-control" style="text-transform:uppercase; margin-left: auto; margin-right: auto;text-align: center; width: 25%;" maxlength="4" name="aircraft">
                            </td>
                        </tr>
                    </tbody></table>
                <center><button class="btn-success btn">Book</button></center><br><br><br>
        </center></form></center></center>
</section>
@endsection
