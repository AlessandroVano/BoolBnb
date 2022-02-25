@extends('layouts.app')

@section('content')
    <section class="container">
        <h1>Find your ideal sponsorship</h1>

        @foreach ($sponsorships as $sponsorship)
            <div class="card my-2">
                <div>{{ $sponsorship->name }}</div>
                <div>{{ $sponsorship->price }}</div>
                <div>{{ $sponsorship->duration }}</div>
            </div>
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary mx-2">Return to list</a>
        @endforeach

    </section>
@endsection