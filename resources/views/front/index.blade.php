@extends('landing')

@section ('style')

<style>
  body {
    min-height: 100%;
    background: url('{{ EventInfo::first()->background_image }}') no-repeat 0 0;
    background-size: cover;
  }
  </style>

<!-- Custom styles for this template -->
<link href="{{ url('/') }}/css/c-scrolling-nav.css" rel="stylesheet">

@endsection

@section('title', 'Home')

@section('content')

<header class="text-white">
    <div class="container text-center">
      <h1>{{ $event->title_text }}</h1>
      <p class="lead">{{ $event->below_title_text }}</p>
    </div>
  </header>

<section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <img src="{{ $event->banner_link }}" style="min-width: 10%; max-width: 100%;">
          <p style="color: white;">{!! html_entity_decode($event->event_text) !!}</p>
        </div>
      </div>
    </div>
  </section>

@endsection
