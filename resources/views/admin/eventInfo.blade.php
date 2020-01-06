@extends('landing')

@section('title', 'Event Information')

@section('content')
<section id="about" style="width: 50%; margin-left: auto; margin-right: auto;">
    <form method="POST" action="{{ route('admin.edit.event') }}">
    @csrf
    <h2 style="text-align: center;">All Bookings</h2>
    <h5>Bookings End</h5>
    <input class="form-control" id="b_end" name="booking_end" value="{{ $event->bookings_end }}">
    <h5>Event Airport ICAO</h5>
    <input class="form-control" name="icao" value="{{ $event->icao }}">
    <h5>Number of allowed bookings</h5>
    <input class="form-control" name="allowed" value="{{ $event->allowed_bookings }}">
    <h5>Charts Link</h5>
    <input class="form-control" name="chart" value="{{ $event->chart_link }}">
    <h5>Background Image</h5>
    <input class="form-control" name="back_img" value="{{ $event->background_image }}">
    <h5>Banner Link</h5>
    <input class="form-control" name="banner" value="{{ $event->banner_link }}">
    <h5>Event Name</h5>
    <input class="form-control" name="ev_name" value="{{ $event->event_name }}">
    <h5>Event Date</h5>
    <input class="form-control" name="ev_date" value="{{ $event->event_date }}">
    <h5>Front Page Title</h5>
    <input class="form-control" name="title" value="{{ $event->title_text }}">
    <h5>Below the Title Text</h5>
    <input class="form-control" name="b_title" value="{{ $event->below_title_text }}">
    <h5>Start Time</h5>
    <input class="form-control" name="start" value="{{ $event->start_time }}">
    <h5>End time</h5>
    <input class="form-control" name="end" value="{{ $event->end_time }}">
    <h5>Event Text</h5>
    <textarea id="event_text" name="ev_text">{{ $event->event_text }}</textarea>
    <p></p>
    <button class="btn btn-success">Edit</button>
    </form>
</section>
@endsection

@section('scripts')
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.tiny.cloud/1/praqpd7d0xf52i2gz56zbin10mljpus8vd696m1fvwapi9rj/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
      selector: '#event_text'
    });
  </script>
@endsection

