@extends('layouts.dashboard')

@section('content')
  <div class="container-fluid">
    {{-- ROW --}}
    <div class="row">
      {{-- COL --}}
      <div class="col-md-10">
        <div class="conteiner-fluid d-flex justify-content-between flex-wrap">
          @foreach ($user_messages as $messages)
            @foreach($messages as $message)
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
          @endforeach
        </div>
      </div>
      {{-- /COL --}}

      {{-- COL --}}
      <div class="col-md-2">
        <p>Filtra i messaggi per appartamento</p>
        <div class="apartments-list">
          <ul class="list-group">
            @foreach ($user_apartments as $apartment)
              <div>
                <a href="{{ route('user.message.apartment-messages', ['message' => $apartment->id]) }}">
                  <li class="list-group-item list-group-item-info">
                    <p>{{ $apartment->title }}</p>
                    <p>{{ $apartment->address }}</p>
                  </li>
                </a>
              </div>
            @endforeach
          </ul>
        </div>
      </div>
      {{-- /COL --}}
    </div>
    {{-- /ROW --}}
  </div>
@endsection