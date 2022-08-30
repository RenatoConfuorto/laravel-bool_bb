@extends('layouts.user')

@section('content')
<div class="container-fluid">
  <h1>Modifica l'appartamento</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="mt-3" action="{{ route('user.apartment.update', ['apartment' => $apartment->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    {{-- TITLE --}}
    <div class="mb-3">
      <label for="title" class="form-label">Titolo *</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ? old('title') : $apartment->title }}" required minlength="4" maxlength="255">
    </div>
    {{-- /TITLE --}}

    {{-- PRICE --}}
    <div class="mb-3">
      <label for="price" class="form-label">Prezzo *</label>
      <input type="number" class="form-control" id="price" name="price" value="{{ old('price') ? old('price') : $apartment->price }}" required min="0" max="9999" step="0.01">
    </div>
    {{-- /PRICE --}}

    {{-- DESCRIPTION --}}
    <div class="mb-3">
      <label for="description" class="form-label">Descrizione</label>
      {{-- TEXT area non ha attributo value quindi old() va all'interno del tag --}}
      <textarea type="text" class="form-control" id="description" name="description" rows="5" required minlength="10" maxlength="10000">{{ old('description') ? old('description') : $apartment->description }}</textarea>
    </div>
    {{-- /DESCRIPTION --}}

    {{-- ROOMS NUMBER --}}
    <div class="mb-3">
      <label for="rooms_number" class="form-label">Numero di stanze *</label>
      <input type="number" class="form-control" id="rooms_number" name="rooms_number" value="{{ old('rooms_number') ? old('rooms_number') : $apartment->rooms_number }}" required min="1" max="255">
    </div>
    {{-- /ROOMS NUMBER --}}

    {{-- BATHROOMS NUMBER --}}
    <div class="mb-3">
      <label for="bathrooms_number" class="form-label">Numero di bagni *</label>
      <input type="number" class="form-control" id="bathrooms_number" name="bathrooms_number" value="{{ old('bathrooms_number') ? old('bathrooms_number') : $apartment->bathrooms_number }}" required min="1" max="255">
    </div>
    {{-- /BATHROOMS NUMBER --}}

    {{-- BEDS NUMBER --}}
    <div class="mb-3">
      <label for="beds_number" class="form-label">Numero di letti *</label>
      <input type="number" class="form-control" id="beds_number" name="beds_number" value="{{ old('beds_number') ? old('beds_number') : $apartment->beds_number }}" required min="1" max="255">
    </div>
    {{-- /BEDS NUMBER --}}

    {{-- MQS --}}
    <div class="mb-3">
      <label for="mqs" class="form-label">Metri quadrati *</label>
      <input type="number" class="form-control" id="mqs" name="mqs" value="{{ old('mqs') ? old('mqs') : $apartment->mqs }}" required min="1" max="65535">
    </div>
    {{-- /MQS --}}

    {{-- ADDRESS --}}
    <div class="mb-3">
      <label for="address" class="form-label">Indirizzo *</label>
      <input type="text" class="form-control" id="address" name="address" value="{{ old('address') ? old('address') : $apartment->address }}" required minlength="4" maxlength="255">
    </div>
    {{-- /ADDRESS --}}

    {{-- COVER IMAGE --}}
    <div class="mb-3">
      <label for="image-cover">Aggiungi un immagine *</label>
      <input type="file" id="image-cover" name="image-cover" accept=".jpg, .jpeg, .png, .bmp, .gif, .svg, .webp">
    </div>
    {{-- /COVER IMAGE --}}

    {{-- EXTRA SERVICES --}}
    <p>Servizi Extra *</p>
    @foreach ($extra_services as $extra_service)
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="{{ $extra_service->id }}" id="extra_service-{{ $extra_service->id }}" name="extra_services[]" {{ ($apartment->services->contains($extra_service) || in_array($extra_service->id, old('extra_services', []))) ? 'checked' : '' }}>
      <label class="form-check-label" for="extra_service-{{ $extra_service->id }}">
        {{ $extra_service->name }}
      </label>
    </div>
    @endforeach
    {{-- EXTRA SERVICES --}}

    {{-- VISIBILITY --}}
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
      <label class="form-check-label" for="flexCheckChecked">
        Vuoi rendere questo appartemento visibile? *
      </label>
    </div>
    {{-- /VISIBILITY --}}

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
<div>
@endsection