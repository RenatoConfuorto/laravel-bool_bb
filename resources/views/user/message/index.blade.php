@extends('layouts.dashboard')

@section('content')
  <h1>I TOUI MESSAGGI</h1>
    @foreach ($messages as $message)
      <div>
        <h4>{{$message.email}}</h4>
        <p>{{ $message.text }}</p>
      </div>

    @endforeach
@endsection