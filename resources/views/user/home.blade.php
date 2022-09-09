@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div>
            @if ($user->name && $user->lastname)
                Ciao {{$user->name}} {{ $user->lastname }}
            @else
                Ciao {{ $user->email }}
            @endif
        </div>
        <p>Da quaesta pagina puoi gestire i tuoi appartamenti.</p>
    </div>
@endsection
