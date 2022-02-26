@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            {{-- Name --}}
            <h1 class="col-12 text-center text-white">{{ $apartment->name }}</h1>
            <div class="col-sm-12 col-md-6 my-4 text-center">
                @if (! $apartment->image)
                    <img class="img-fluid" src="{{ asset('storage/img-apartments/Not-found.png') }}" alt="{{ $apartment->name }}">
                @else
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->name }}">
                @endif
            </div>
            <div class="col-sm-12 col-md-6">
                <ul class="list-group list-group-flush">
                    {{-- Price for night --}}
                    <li class="list-group-item">
                        {{ $apartment->price }} € /<strong>For night</strong> 
                    </li>
                    {{-- Rooms and occupants --}}
                    <li class="list-group-item">
                        <img class="icon" src="{{ asset('storage/icon/Rooms.png') }}" alt="Rooms's icon">
                        {{ $apartment->rooms }} <strong>Rooms </strong> 
                        <img class="icon" src="{{ asset('storage/icon/Max occupants.png') }}" alt="Max occupants's icon">
                        {{ $apartment->max_people }} <strong>Max occupants</strong>
                    </li>
                    {{-- Bathrooms --}}
                    <li class="list-group-item">
                        <img class="icon" src="{{ asset('storage/icon/Bathrooms.png') }}" alt="Bathroom's icon">
                        {{ $apartment->bathrooms }} <strong>Bathroom</strong> 
                    </li>
                    {{-- Description --}}
                    <li class="list-group-item">
                        <strong>Something about: </strong> <br> {{ $apartment->description }}
                    </li>
                    {{-- Geography position --}}
                    <li class="list-group-item">
                        <img class="icon" src="{{ asset('storage/icon/Geography.png') }}" alt="Geography's icon">
                        <strong>Geography position: </strong> LAT {{ $apartment->latitude }} LONG {{ $apartment->longitude }}
                    </li>
                    {{-- Services --}}
                    <li class="list-group-item">
                        <strong>Services: </strong> 
                        @if ( $apartment->services->isEmpty())
                        Sorry no service available has been specified.
                        @else
                        @foreach ($apartment->services as $service)
                        <img class="icon" src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}'s icon">
                        <span class="badge rounded-pill bg-success ms-1">{{ $service->name }}</span>
                        @endforeach
                        @endif
                    </li>
                    {{-- ACTIONS --}}
                    <li class="list-group-item">
                        <strong>Actions: </strong>
                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary mx-2">Return to list</a>
                        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-success mx-2">Edit details</a>
                    </li>

                    <li class="list-group-item">
                        <a href="{{ route('admin.sponsorships') }}">Sponsorship</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection