@extends('layouts.dashboard')

@section('content')
  <div class="conteiner d-flex justify-content-center flex-wrap">
    @foreach ($messages as $message)
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <p>Messaggio ricevuto il: {{ $message->created_at->format('d m Y') }}</p>
        <h5 class="card-title">{{ $message->apartment->address }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $message->email }}</h6>
        <p class="card-text">{{ $message->text}}</p>
        <a href="{{ route('user.message.show', ['message' => $message->id]) }}" class="card-link">Leggi il messaggio completo</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
    @endforeach
  </div>
@endsection