@extends('layouts.user')

@section('content')
  <h1>{{ $apartment->title }}</h1>
  <h2>{{ $apartment->slug }}</h2>
  <p>{{ $apartment->description }}</p>

  <p>   <strong>Servizi : </strong>
  @forelse ($apartment->services as $service)
    {{ $service->name }} {{$loop -> last ? '' : ', '}}
  @empty
    Vuoto  
  @endforelse
    </p>
  <li>
    <a href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}">Modifica</a>
  </li>
@endsection