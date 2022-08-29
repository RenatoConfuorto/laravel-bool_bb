@extends('layouts.user')

@section('content')
    @foreach ($apartments as $apartment)
        <h1>{{ $apartment->title }}</h1>
        <h2>{{ $apartment->slug }}</h2>
        <p>{{ $apartment->description }}</p>
        <a href="{{ route('user.apartment.show', ['apartment' => $apartment->id ]) }}">Dettagli</a>

    @endforeach
@endsection