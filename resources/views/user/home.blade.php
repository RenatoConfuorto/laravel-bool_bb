@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div>
        Sei loggato con {{$user->email}}
    </div>
</div>
@endsection
