@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
  @if(session('message'))
    <div class="alert alert-success position-absolute top-50 start-50 translate-middle px-5">
      {{ session('message') }}
    </div>
  @endif
  <div>
    @if (str_contains($apartment->image, 'picsum'))
      <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
    @else
      <img src="{{ asset('storage/' . $apartment->image ) }}" alt="{{ $apartment->title }}">
    @endif
  </div>
  <h1>{{ $apartment->title }}</h1>
  <h2>{{ $apartment->slug }}</h2>
  <h3>{{ $apartment->address }}</h3>
  <p>{{ $apartment->description }}</p>

  <p>   <strong>Servizi : </strong>
  @forelse ($apartment->services as $service)
    {{ $service->name }} {{$loop -> last ? '' : ', '}}
  @empty
    Vuoto  
  @endforelse
  </p>

  <div>
    <a class="btn btn-primary" href="{{ route('user.message.apartment-messages', ['message' => $apartment->id]) }}">Leggi i messaggi per questo appartamento</a>
  </div>
  
  <div>
    <a class="btn btn-primary" href="{{ route('user.visual.views', ['apartment' => $apartment->id]) }}">Visual</a>
  </div>

  <div>
    <a class="btn btn-primary" href="{{ route('user.apartment.index') }}">Torna alla lista dei tuoi appartamenti</a>
  </div>

  <div>
    <a class="btn btn-primary" href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}">Modifica i dettagli di questo appartamento</a>
  </div>

  <form action="{{ route('user.apartment.destroy', ['apartment' => $apartment->id]) }}" method="POST">
    @method('DELETE')
    @csrf
      <button type="submit" class="btn btn-danger" onclick="return confirm('Vuoi davvero cancellare questo appartamento?')">Cancella questo appartamento</button>
  </form>
  <div class="card-deck justify-content-around text-center">
    @foreach ($sponsor_types as $sponsor_type)
    <form action="{{route('makePayment')}}" method="post" enctype="multipart/form-data" class="card col-lg-4 mt-4 mb-5 border border-primary text-primary pt-3 pb-3">
      {{-- <div class="card"> --}}
        <h2 class="card-title">{{$sponsor_type->name}}</h2>
        <h2 class="card-title">€ {{$sponsor_type->price}}</h2>
        <hr>
        <h5 class="card-title">Sponsorizza il tuo appartamento per {{$sponsor_type->duration_h}} ore!</h5>
        <input type="hidden" name="apartment_id" value="{{$apartment->id}}">
        <input type="hidden" name="costo" value="{{$sponsor_type->price}}">
        <input type="hidden" name="sponsor_id" value="{{$sponsor_type->id}}">
        @csrf
        @method('GET')
        <input type="submit" class="btn btn-success" value="Acquista">
      {{-- </div> --}}
    </form>
    @endforeach
    {{-- </form> --}}
  </div>
  <script>
    const successMessage = document.querySelector('.alert.alert-success');

  <script>
    const successMessage = document.querySelector('.alert.alert-success');

    setTimeout(function(){
      successMessage.remove();
    }, 3000);
  </script>
@endsection