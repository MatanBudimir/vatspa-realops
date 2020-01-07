@component('mail::message')
Dear <b>{{ $user->fname }} {{ $user->lname }}</b>,<br>
<br>
Thank you for your booking on <b>{{ App\Models\EventInfo::first()->event_name }}</b> event.<br>
<hr>
<div class="table" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
    <table style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
    <tbody style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
    <tr>
    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">Callsign:</td>
    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $booking->callsign }}</td>
    </tr>
    <tr>
    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">Departure:</td>
    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $booking->dep_icao }}</td>
    </tr>
    <tr>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">Arrival:</td>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $booking->arr_icao }}</td>
    </tr>
    <tr>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">Aircraft:</td>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $booking->aircraft }}</td>
    </tr>
    @if ($booking->type == 'ARR')
    <tr>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">STA:</td>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $booking->eta }}</td>
    </tr>
    @else
    <tr>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">STD:</td>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $booking->etd }}</td>
    </tr>
    @endif
    </tbody>
    </table>
    </div>


Regards,<br>
<b>VATSPA</b>
@endcomponent
