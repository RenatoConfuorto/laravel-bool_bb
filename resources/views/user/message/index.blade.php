@extends('layouts.dashboard')

@section('content')
  {{-- {{dd($user_messages[0])}} --}}
  <h1>I TUOI MESSAGGI</h1>
  <div class="conteiner d-flex justify-content-center flex-wrap">
    @foreach ($user_messages as $messages)
      @foreach($messages as $message)
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            {{-- <h5 class="card-title">{{ $message->apartment->address }}</h5> --}}
            <h5 class="card-title">{{ $message->apartment_id }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $message->email }}</h6>
            <p class="card-text">{{ $message->text}}</p>
            <a href="{{ route('user.message.show', ['message' => $message->id]) }}" class="card-link">Leggi il messaggio completo</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
      @endforeach
    @endforeach
  </div>
@endsection