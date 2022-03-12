@extends('layouts.app')

@section('content')
<h1 class="text-white text-center my-3">Welcome to the Sponsorship Section</h1>

<section class="container">
    <h3 class="text-white text-center my-3">Choose the best package for you</h3>

    <p class="text-white h5 my-4">Start a period of sponsorship and improve the Visibility of you apartment. After the purchase the sponsored apartment will always be placed before an other apartment with the same features and services. <br> An other advantage is the "Best Apartment Section", in fact the sponsored apartment will be placed in that section of our website, that is one of the most visited!</p>
    
    <div class="row mb-3 justify-content-around">
        @foreach ($sponsorships as $sponsorship)
        <div class="card text-center card-hover col-3">
            <div class="card-body">
                <h4 class="card-title"> <strong>Sponsorship Type</strong></h4>
                <h2><strong>{{ $sponsorship->name }}</strong></h2>
                <div class="my-3">
                    <h5 class="card-subtitle mb-2"><strong>Price:</strong> {{ $sponsorship->price}} €</h5>
                    <h5 class="card-subtitle mb-2"><strong>Duration:</strong> {{$sponsorship->duration }} H</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
            
            <form action="">
            <input id="apartment" type="text" hidden value="{{$apartment->id}}">
            <div class="mb-3">
                <label class="form-label text-white" for="username">Nome Utente</label>
                <input class="form-control" type="text" disabled value="{{ Auth::user()->name }} {{ Auth::user()->surname}}">
            </div>

            <div class="mb-3">
                <label class="form-label text-white" for="email">Email Utente</label>
                <input class="form-control" type="text" disabled value="{{ Auth::user()->email }}">
            </div>

            <div class="mb-3 text-white">
                <label class="form-label" for="apartment">Apartment Selected</label>
                <input  class="form-control" type="text" disabled value="{{$apartment->name}}">
            </div>

            <div class=" mb-1 text-white">Select Your Package</div>
            <div class="input-group-prepend mb-3">
                <label class="input-group-text" for="sponsor">Packages</label>
                <select name="sponsor" id="sponsor" class="custom-select">
                    @foreach ($sponsorships as $sponsorship )
                    <option value="{{$sponsorship->id}}">{{$sponsorship->name}}</option>
                    @endforeach
                </select>
            </div>
        </form>
        
        {{-- Form Pagamento BrainTree --}}
        <div id="dropin-wrapper">
            <div id="checkout-message"></div>
            <div id="dropin-container"></div>
            <button type="submit" id="submit-button" class="btn btn-pink">Purchase</button>
        </div>


        @section('script')
        <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
        <script src="{{asset('js/braintree.js')}}" defer></script>
        @endsection

        <button class="btn btn-pink mx-auto d-block my-5">
            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="text-white">Back to the apartment</a>
        </button>

        
    </section>
@endsection