@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="text-white">Find your ideal sponsorship</h1>
        <h3 class="text-white">for: {{ $apartment->name }}</h3>
        <input id="apartment" type="text" hidden value="{{$apartment->id}}">

        <div class="row mb-3 justify-content-around">
            @foreach ($sponsorships as $sponsorship)
            {{-- <a href="{{route('admin.test', $sponsorship->id)}}" class="col-lg-4 col-sm-12 m-sm-2 m-lg-0"> --}}

                <div class="card text-center card-hover col-3">
                    <div class="card-body">
                        <h2 class="card-title"> <strong>Sponsorship Type</strong></h2>
                            <h2>{{ $sponsorship->name }}</h2>
                        <div class="my-3">
                            <h5 class="card-subtitle mb-2"><strong>Price:</strong> {{ $sponsorship->price}} €</h5>
                            <h5 class="card-subtitle mb-2"><strong>Duration:</strong> {{$sponsorship->duration }} H</h5>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>


        <div id="dropin-wrapper">
            <select name="sponsor" id="sponsor">
                @foreach ($sponsorships as $sponsorship )
                        <option value="{{$sponsorship->id}}">{{$sponsorship->name}}</option>
                @endforeach
            </select>


            <div id="checkout-message"></div>
            <div id="dropin-container"></div>

            <button type="submit" id="submit-button" class="button button--small button--green">Purchase</button>
        </div>


        @section('script')
        <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
        <script src="{{asset('js/braintree.js')}}" defer></script>
        @endsection

        <button class="btn btn-pink mx-auto d-block my-5">
            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="text-white">Return to apartment</a>
        </button>

        
    </section>
@endsection