@extends('layouts.dashboard')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/apartment-card-backend.css') }}">
@endpush

@section('content')
    <div class="container-fluid d-flex justify-content-center flex-wrap">
        {{-- @foreach ($apartments as $apartment) --}}
            {{-- BOOTSTRAP CARD --}}
            {{-- <div class="card" style="width: 18rem;">
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
            </div> --}}
            {{-- BOOTSTRAP CARD --}}
        {{-- @endforeach --}}


        @foreach ($apartments as $apartment)
        <div class="card-wrapper">
            <div class="img-wrapper">
                @if (str_contains($apartment->image, 'picsum'))
                    <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
                @else
                    <img src="{{ asset('storage/' . $apartment->image ) }}" alt="{{ $apartment->title }}">
                @endif
            </div>
            <div class="content-wrapper">
                <h4>
                    <span class="title">Titolo:</span>
                    {{$apartment->title}}
                </h4>
                <p>
                    <span class="title">Indirizzo:</span>
                    {{$apartment->address}}
                </p>
                <p>
                    <span class="title">Slug:</span>
                    {{$apartment->slug}}
                </p>
                <div class="link-button mb-2">
                    <a class="btn btn-primary" href="{{ route('user.apartment.show', ['apartment' => $apartment->id ]) }}">Dettagli</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection