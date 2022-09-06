@extends('layouts.dashboard')

@section('content')
  <h1>I TOUI MESSAGGI</h1>
  <div class="conteiner d-flex justify-content-center flex-wrap">
    @foreach ($user_messages as $message)
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $message->email }}</h6>
        <p class="card-text">{{ $message->text}}</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
    @endforeach
  </div>
@endsection