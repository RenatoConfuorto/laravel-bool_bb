@extends('layouts.dashboard')

@push('css')
  <link rel="stylesheet" href="{{ asset('css/apartment-messages-navbar.css') }}">
@endpush

@section('content')
<div id="root">
  <div class="container-fluid d-flex flex-column">
    {{-- ROW --}}
    <div class="row">
      <div class="col-md-9">
        <h3 class="text-light text-center mt-2">Messaggi ricevuti</h3>
      </div>
      <div class="col-md-3">
        <h4 class="text-light text-center mt-2">Filtra i messaggi per appartamento</h4>
      </div>
    </div>
    <div class="row elements-container">
      <div class="col-md-9">
        <div class="container-fluid d-flex justify-content-around flex-wrap">
          @foreach ($user_messages as $message)
            <message-card :message="{{ $message }}" route-to-details="{{ route('user.message.show', ['message' => $message->id]) }}"></message-card>
          @endforeach
        </div>
      </div>

      <div class="col-md-3">
        <div class="apartments-list">
          <ul class="list-group">
            @foreach ($user_apartments as $apartment)
              <messages-navbar :apartment="{{ $apartment }}" route-to-apartment-messages="{{ route('user.message.apartment-messages', ['message' => $apartment->id]) }}"></messages-navbar>
            @endforeach
          </ul>
        </div> 
      </div>

    </div>
    {{-- /ROW --}}
  </div>
</div>
<script src="{{ asset('js/front.js') }}"></script>
@endsection