
@extends('layouts.app')

@section('content')
    <h1>Compra il pacchetto</h1>
    <h3>{{$sponsorship->name}}</h3>
    <div id="dropin-wrapper">
        <div id="checkout-message"></div>
        <div id="dropin-container"></div>
        <button type="submit" id="submit-button" class="button button--small button--green">Purchase</button>
    </div>
@endsection



@section('script')

<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
<script src="{{asset('js/braintree.js')}}" defer></script>
@endsection