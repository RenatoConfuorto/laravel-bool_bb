@extends('layouts.dashboard')

@section('content')
  <div class="conteiner d-flex justify-content-center flex-wrap">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Appartamento</h5>
        @if ($message->user_name)
            <h6 class="card-title">Messaggio da: {{ $message->user_name . ' ' . $message->user_lastname }}</h6>
        @endif
        <h6 class="card-subtitle mb-2 text-muted">Email: {{ $message->email }}</h6>
        <p class="card-text">{{ $message->text}}</p>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
  </div>
@endsection