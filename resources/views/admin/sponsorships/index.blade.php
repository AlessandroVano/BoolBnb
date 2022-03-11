@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="text-white my-4 text-center">Find your ideal sponsorship package</h1>

        <div class="row mb-3">
            @foreach ($sponsorships as $sponsorship)
            <div class="col-lg-4 col-sm-12 m-sm-2 m-lg-0">
                <div class="card text-center card-hover">
                    <div class="card-body">
                        <h2 class="card-title"> <strong>Sponsorship Type</strong></h2>
                            <h2>{{ $sponsorship->name }}</h2>
                        <div class="my-3">
                            <h5 class="card-subtitle mb-2"><strong>Price:</strong> {{ $sponsorship->price}} €</h5>
                            <h5 class="card-subtitle mb-2"><strong>Duration:</strong> {{$sponsorship->duration }} H</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="btn btn-pink mx-auto d-block my-5">
            <a href="{{ route('admin.apartments.index') }}" class="text-white text-decoration-none">Return to list</a>
        </button>
    </section>
@endsection