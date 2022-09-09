@extends('layouts.dashboard')

@section('content')
    <div class="container d-flex justify-content-center flex-wrap">
        @foreach ($apartments as $apartment)
            {{-- BOOTSTRAP CARD --}}
            <div class="card" style="width: 18rem;">
                @if (str_contains($apartment->image, 'picsum'))
                    <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
                @else
                    <img src="{{ asset('storage/' . $apartment->image ) }}" alt="{{ $apartment->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $apartment->title }}</h5>
                    <p class="card-text">{{ $apartment->slug }}</p>
                    <p class="card-text">{{ $apartment->description }}</p>
                    <div>
                        <a href="{{ route('user.apartment.show', ['apartment' => $apartment->id ]) }}">Dettagli</a>
                    </div>
                </div>
            </div>
            {{-- BOOTSTRAP CARD --}}
        @endforeach
    </div>
@endsection