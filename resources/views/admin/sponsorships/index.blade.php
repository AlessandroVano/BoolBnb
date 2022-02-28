@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="text-white">Find your ideal sponsorship</h1>

        <div class="row mb-3">
            @foreach ($sponsorships as $sponsorship)
            <div class="col-lg-4 col-sm-12 m-sm-2 m-lg-0">
                <div class="card text-center card-hover">
                    <div class="card-body">
                        <h2 class="card-title"> <strong>Type:</strong> {{ $sponsorship->name }}</h2>
                        <h3 class="card-subtitle mb-2"><strong>Price:</strong> {{ $sponsorship->price}} €</h3>
                        <h4 class="card-subtitle mb-2"><strong>Duration:</strong> {{$sponsorship->duration }} H</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary mx-2">Return to list</a>
    </section>
@endsection