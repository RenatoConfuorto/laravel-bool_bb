@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
  @if(session('message'))
    <div class="alert alert-success position-absolute top-50 start-50 translate-middle px-5">
      {{ session('message') }}
    </div>
  @endif
  <div>
    @if (str_contains($apartment->image, 'picsum'))
      <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
    @else
      <img src="{{ asset('storage/' . $apartment->image ) }}" alt="{{ $apartment->title }}">
    @endif
  </div>
  <h1>{{ $apartment->title }}</h1>
  <h2>{{ $apartment->slug }}</h2>
  <h3>{{ $apartment->address }}</h3>
  <p>{{ $apartment->description }}</p>

  <p>   <strong>Servizi : </strong>
  @forelse ($apartment->services as $service)
    {{ $service->name }} {{$loop -> last ? '' : ', '}}
  @empty
    Vuoto  
  @endforelse
  </p>

  <div>
    <a class="btn btn-primary" href="{{ route('user.message.apartment-messages', ['message' => $apartment->id]) }}">Leggi i messaggi per questo appartamento</a>
  </div>

  <div>
    <a class="btn btn-primary" href="{{ route('user.apartment.index') }}">Torna alla lista dei tuoi appartamenti</a>
  </div>

  <div>
    <a class="btn btn-primary" href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}">Modifica i dettagli di questo appartamento</a>
  </div>

  <div>
    <a class="btn btn-primary" href="{{ route('user.sponsor.index', ['apartment' => $apartment->id]) }}">Sponsorizza</a>
  </div>

@endsection