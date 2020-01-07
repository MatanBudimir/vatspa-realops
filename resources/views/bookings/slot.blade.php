@extends('landing')

@section('style')
    <!-- Custom styles for this template -->
    <link href="{{ url('/') }}/css/scrolling-nav.css" rel="stylesheet">
@endsection


@section('title', 'Slot')

@section('style')
    <style>
        td {
            width: 50%;
        }
    </style>
@endsection

@section('content')
<section id="about" style="width: 75%; margin-left: auto; margin-right: auto;">
    <h2 style="text-align: center;">{{ $slot->callsign }} Slot</h2>
        <center class="col-lg-12">
            <center>
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
                                <form action="{{ route('user.edit.slot') }}" method="POST">
                                @csrf
                                <input hidden value="{{ $slot->unique_id }}" name="uid">
                                <input class="form-control" maxlength="4" style="text-transform:uppercase; margin-left: auto; margin-right: auto;text-align: center; width: 25%;" value="{{ $slot->aircraft }}" name="aircraft">
                            </td>
                        </tr>
                    </tbody></table>
                <center><button class="btn-success btn">Edit Slot</button></center>
            </form><p></p>
            <center><form action="{{ route('user.delete.slot') }}" method="POST">
                @csrf
                <input hidden value="{{ $slot->unique_id }}" name="uid">
                <button class="btn-danger btn">Delete Slot</button>
            </form>
        </center>
            <p></p>
            <center><a href="https://cert.vatsim.net/fp/file.php?2={{ $slot->aircraft }}&5={{ $slot->dep_icao }}&6={{ substr($slot->etd, 11, 16) }}&9={{ $slot->arr_icao }}&11=Flying on {{ App\Models\EventInfo::first()->event_name }}, you can book your slot on {{ url('/') }}&14={{ Auth::user()->fname }} {{ Auth::user()->lname }}" target="_blank"><button class="btn-primary btn">Prefile</button></a></center>
        </center></center></center>
</section>
@endsection
