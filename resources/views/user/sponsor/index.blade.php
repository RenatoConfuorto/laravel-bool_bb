@extends('layouts.dashboard')
@section('content')
  @if (session('success_message'))
  <div class="alert alert-success">
    {{ session('success_message')}}
  </div>
  @endif
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

<div class="container">
  <form method="post" id="payment-form" action="{{ route('api.orders.payment', ['apartment' => $apartment->id]) }}">
    @csrf
    @method("POST")
      <section>

        @foreach($sponsor_types as $sponsor )
          <span class="input-label">Sponsor {{ $sponsor->name }}</span>
          <span class="input-label">Durata {{ $sponsor->duration }}</span>
          <span class="input-label">Sponsor {{ $sponsor->price }}</span>
          <div class="input-wrapper amount-wrapper">
              <input id="{{$sponsor->id}}" name="amount" type="radio" placeholder="Amount" value="{{$sponsor->price}}">
          </div>
          <div>
            <input id="{{ $sponsor->id }}" type="number" name="sponsor_id" class="d-none"
              value="{{$sponsor->id}}" >
          </div>
        @endforeach

        <div class="bt-drop-in-wrapper">
            <div id="bt-dropin"></div>
        </div>
      </section>

      <input id="nonce" name="payment_method_nonce" type="hidden" />
      <button class="button" type="submit"><span>Test Transaction</span></button>
  </form>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script> 
  <script>
       const form = document.querySelector('#payment-form');
       let client_token = "{{$token}}";
       console.log('token', client_token);
       braintree.dropin.create({
         authorization: client_token,
         selector: '#bt-dropin',
         paypal: {
           flow: 'vault'
         }
       }, function (createErr, instance) {
         if (createErr) {
           console.log('Create Error', createErr);
           return;
         }
         form.addEventListener('submit', function (event) {
           event.preventDefault();
           instance.requestPaymentMethod(function (err, payload) {
             if (err) {
               console.log('Request Payment Method Error', err);
               return;
             }
             document.querySelector('#nonce').value = payload.nonce;
             form.submit();
           });
         });
       });
   </script>
@endsection