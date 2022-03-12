@extends('layouts.app')

@section('content')
<h1 class="text-white text-center my-3">Welcome to the Sponsorship Section</h1>

<section class="container">
    
    <p class="text-white h5 my-4">Start a period of sponsorship and improve the visibility of you apartment. After the purchase the sponsored apartment will always be placed before an other apartment with the same features and services. <br> An other advantage is the "Home Page Section", in fact the sponsored apartment will be placed in that Home Page of our website, that is the most visited!</p>
    <h3 class="text-pink text-center my-3">Choose the best package for you</h3>
    
    <div class="row mb-3 justify-content-around">

        @foreach ($sponsorships as $sponsorship)
        <div class="card text-center card-hover col-10 my-3 col-md-3 c-custom-back">
            <div class="card-body">
                <h4 class="card-title"> <strong>Sponsorship Type</strong></h4>
                <h2 class="text-uppercase"><strong>{{ $sponsorship->name}}</strong></h2>
                <div class="my-3">
                    <h5 class="card-subtitle mb-2"><strong>Price:</strong> {{ $sponsorship->price}} €</h5>
                    <h5 class="card-subtitle mb-2"><strong>Duration:</strong> {{$sponsorship->duration }} H</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
            <h3 class="text-center text-white my-3"> Order Summary</h3>
            <form>
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
        <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
        <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
        <script src="{{asset('js/braintree.js')}}" defer></script>
        @endsection

        <button class="btn btn-pink mx-auto d-block my-5">
            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="text-white">Back to the apartment</a>
        </button>

        
    </section>
@endsection