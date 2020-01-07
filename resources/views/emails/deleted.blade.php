@component('mail::message')
Dear <b>{{ $user->fname }} {{ $user->lname }}</b>,<br>
<br>
Your booking for <b>{{ App\Models\EventInfo::first()->event_name }}</b> event was deleted.<br>

Regards,<br>
<b>VATSPA</b>
@endcomponent
