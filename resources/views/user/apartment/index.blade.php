@extends('layouts.user')

@section('content')
    @foreach ($apartments as $apartment)
        <div>
            <img src="{{ $apartment->image }}" alt="">
        </div>
        <h1>{{ $apartment->title }}</h1>
        <h2>{{ $apartment->slug }}</h2>
        <p>{{ $apartment->description }}</p>
        <div>
            <a href="{{ route('user.apartment.show', ['apartment' => $apartment->id ]) }}">Dettagli</a>
        </div>

    @endforeach
@endsection