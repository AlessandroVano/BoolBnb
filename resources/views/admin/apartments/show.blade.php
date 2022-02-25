@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            {{-- Name --}}
            <h1 class="col-12 text-center">{{ $apartment->name }}</h1>
            <div class="col-sm-12 col-md-6 my-4 text-center">
                <img class="img-fluid" src="{{ $apartment->image }}" alt="{{ $apartment->name }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <ul class="list-group list-group-flush">
                    {{-- Price for night --}}
                    <li class="list-group-item">
                        {{ $apartment->price }} € /<strong>For night</strong> 
                    </li>
                    {{-- Rooms and occupants --}}
                    <li class="list-group-item">
                        <img class="icon" src="https://cdn-icons.flaticon.com/png/512/2400/premium/2400622.png?token=exp=1645804588~hmac=187dd772442bbbf969bdda797c63da86" alt="Rooms's icon">
                        {{ $apartment->rooms }} <strong>Rooms </strong> 
                        <img class="icon" src="https://cdn-icons-png.flaticon.com/512/615/615075.png" alt="Max occupants's icon">
                        {{ $apartment->max_people }} <strong>Max occupants</strong>
                    </li>
                    {{-- Bathrooms --}}
                    <li class="list-group-item">
                        <img class="icon" src="https://cdn-icons-png.flaticon.com/512/1606/1606212.png" alt="Bathroom's icon">
                        {{ $apartment->bathrooms }} <strong>Bathroom</strong> 
                    </li>
                    {{-- Description --}}
                    <li class="list-group-item">
                        <strong>Something about: </strong> <br> {{ $apartment->description }}
                    </li>
                    {{-- Geography position --}}
                    <li class="list-group-item">
                        <img class="icon" src="https://cdn-icons.flaticon.com/png/512/2204/premium/2204655.png?token=exp=1645804359~hmac=d4bdba58f78557dd331e1fc6ca5634de" alt="Geography's icon">
                        <strong>Geography position: </strong> LAT {{ $apartment->latitude }} LONG {{ $apartment->longitude }}
                    </li>
                    {{-- Services --}}
                    <li class="list-group-item">
                        <strong>Services: </strong> 
                        @if ( $apartment->services->isEmpty())
                        Sorry no service available has been specified.
                        @else
                        @foreach ($apartment->services as $service)
                        <img class="icon" src="{{ $service->icon }}" alt="{{ $service->name }}'s icon">
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
                </ul>
            </div>
        </div>
    </div>
@endsection