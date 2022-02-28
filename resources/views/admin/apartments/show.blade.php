@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            {{-- Name --}}
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="d-inline">{{ $apartment->name }}</h1>
                @if ( $apartment->visibility == 1 )
                    <img class="icon" src="{{ asset('storage/icon/Visible.png') }}" alt="Visible">
                @else
                    <img class="icon" src="{{ asset('storage/icon/Not-visible.png') }}" alt="Not visible">
                @endif
            </div>
            <div class="col-sm-12 col-md-6 my-4 align-self-start text-center">
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
                        <div class="row">
                            @foreach ($apartment->services as $service)
                            <div class="col-2 col-md-4 col-lg-6 py-1">
                                <img class="icon" src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}'s icon">
                                <span class="ms-1 d-none d-lg-inline-block">{{ $service->name }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </li>
                    {{-- ACTIONS --}}
                    <li class="list-group-item">
                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-pink mx-2">Return to list</a>
                        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-transparent btn-edit mx-2">Edit details</a>
                    </li>

                    <li class="list-group-item">
                        <a href="{{ route('admin.sponsorships') }}">Sponsorship</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection