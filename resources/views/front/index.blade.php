@extends('landing')

@section('title', 'Home')

@section('content')

<header class="text-white" style="background-image: url('{{ $event->background_image }}');">
    <div class="container text-center">
      <h1>{{ $event->title_text }}</h1>
      <p class="lead">{{ $event->below_title_text }}</p>
    </div>
  </header>

<section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>{{ $event->event_name }} - {{ $event->event_date }}</h2>
          <p class="lead">{{ $event->event_text }}</p>
        </div>
      </div>
    </div>
  </section>

@endsection
