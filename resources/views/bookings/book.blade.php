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
        <center class="col-lg-12">
            <center><form action="{{ route('user.book.slot') }}" method="POST">
                @csrf
                <p></p><b>Please enter the flight details in the boxes below.</b><br><br>
                    <center><table class="table align-center-custom" width="100%">

                        <tbody><tr><td><b>Callsign </b><font size="2">(e.g. DLH123)</font></td>
                            <td>
                                @if ($slot->callsign != '' || $slot->callsign != null)
                                <input maxlength="7" class="form-control" minlength="4" type="text" name="cs">
                                @else
                                <input maxlength="7" readonly class="form-control" minlength="4" value="{{ $slot->callsign }}" type="text">
                                @endif
                            </td>
                        </tr>
                        <tr><td><b>Departure Airport</b></td><td>EDDF<br>Frankfurt Main</td></tr>
                        <tr><td><b>Arrival Airport</b></td><td>RJTT<br>Tokyo Narita</td></tr>
                        <tr><td><b>Estimated Time of Depature </b><font size="2">(ETD)</font></td><td>16:58</td></tr>
                        <tr><td><b>Estimated Time of Arrival </b><font size="2">(ETA)</font></td><td>03:58</td></tr>
                        <tr><td><b>Aircraft </b><font size="2">(e.g. A320, B738, A332, ...)</font></td><td><input class="form-control booking-aircraft" maxlength="4" name="aircraft"></td></tr>
                        <tr><td><b>Route </b><br></td><td></td></tr>
                    </tbody></table>
                <center><button class="btn-success btn">Book</button></center><br><br><br>
        </center></form></center></center>
</section>
@endsection
