@extends('layouts.user')

@section('content')
    <h1>User Dashboard</h1>

    <li>
        <form id="form" action="{{ route('logout') }}" method="POST">
            <input type="submit" value="logout">
            @csrf
        </form>
    </li>

    <li>
        <a href="{{ route('user.apartment.index') }}">I tuoi appartamenti</a>
    </li>

    <li>
        <a href="{{ route('user.apartment.create') }}">Aggiungi un nuovo appartamento</a>
    </li>

@endsection