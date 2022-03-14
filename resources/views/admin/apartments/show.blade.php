@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            {{-- Name --}}
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="d-inline text-white">{{ $apartment->name }}</h1>
                @if ( $apartment->visibility == 1 )
                    <img class="icon invert" src="{{ asset('storage/icon/Visible.png') }}" alt="Visible">
                @else
                    <img class="icon invert" src="{{ asset('storage/icon/Not-visible.png') }}" alt="Not visible">
                @endif
            </div>
            {{-- Image --}}
            <div class="col-sm-12 col-md-8 offset-md-2 my-4 text-center justify-content-center">
                @if (! $apartment->image)
                    <img class="img-fluid rounded" src="{{ asset('storage/img-apartments/Not-found.png') }}" alt="{{ $apartment->name }}">
                @else
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->name }}">
                @endif
            </div>

            {{-- Servizi e dettgli --}}
            <div class="col-sm-12 col-md-12">
                <ul class="list-group list-group-flush rounded">
                    {{-- Price for night --}}
                    <li class="list-group-item">
                        @if ( $apartment->price )
                            {{ $apartment->price }} € /<strong>For night</strong>
                        @else
                            <strong>Price per night not specified</strong>
                        @endif
                    </li>
                    {{-- Rooms and occupants --}}
                    <li class="list-group-item">
                        <img class="icon" src="{{ asset('storage/icon/Rooms.png') }}" alt="Rooms's icon">
                        @if ($apartment->rooms)
                            {{ $apartment->rooms }} <strong>Rooms </strong> 
                        @else
                            <strong>Total rooms not specified </strong>
                                <br/>
                        @endif
                        <img class="icon mt-2" src="{{ asset('storage/icon/Max occupants.png') }}" alt="Max occupants's icon">
                        @if ( $apartment->max_people )
                            {{ $apartment->max_people }} <strong>Max occupants</strong>
                        @else
                            <strong>Maximum capacity of people not specified </strong>
                        @endif
                    </li>
                    {{-- Bathrooms --}}
                    @if ( $apartment->bathrooms )
                        <li class="list-group-item">
                            <img class="icon" src="{{ asset('storage/icon/Bathrooms.png') }}" alt="Bathroom's icon">
                            {{ $apartment->bathrooms }} <strong>Bathroom</strong> 
                        </li>
                    @endif
                    {{-- Description --}}
                    @if ( $apartment->description )
                        <li class="list-group-item">
                            <strong class="text-pink">Something about: </strong> <br> {{ $apartment->description }}
                        </li>
                    @else
                        <li class="list-group-item">
                            <strong class="text-pink">Something about: </strong> <br>
                            Description not available
                        </li>
                    @endif
                    {{-- Geography position --}}
                    <li class="list-group-item">
                        <img class="icon" src="{{ asset('storage/icon/Geography.png') }}" alt="Geography's icon">
                        @if ( $apartment->address )
                            <strong class="text-pink">Address: </strong> {{ $apartment->address }}
                        @else
                            <strong>Address not specified </strong>
                        @endif
                    </li>
                    {{-- Services --}}
                    <li class="list-group-item">
                        <strong class="text-pink">Services: </strong> 
                        @if ( $apartment->services->isEmpty())
                        Sorry no service available has been specified.
                        @else
                        <div class="row">
                            @foreach ($apartment->services as $service)
                            <div class="col-3 col-md-2 my-2 px-0 text-center">
                                <img class="icon" src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}'s icon">
                                <span class="ms-1 d-none d-lg-block">{{ $service->name }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </li>
                    {{-- SPONSORSHIP --}}
                    <li class="list-group-item">
                        @if ($apartment->expiration)
                            <p>Your sponsorship will expire:
                            <strong>{{ $apartment->end_date }}</strong></p>
                            <p>You still have {{ $apartment->daysLeft }} days of sponsorship</p> 
                            <p class="pink d-flex align-items-center">Sponsor again!
                            <a class="btn btn-pink ml-4" href="{{ route('admin.sponsorships.show', $apartment->id) }}">Sponsor Your Apartment</a> </p>
                        @else
                            <p>You do not have active sponsorship in this apartment!</p>
                            <p class="pink d-flex align-items-center">Highlight it!
                            <a class="btn btn-pink ml-4" href="{{ route('admin.sponsorships.show', $apartment->id) }}">Sponsor Your Apartment</a> </p>
                        @endif
                        
                    </li>
                    {{-- ACTIONS --}}
                    <li class="list-group-item d-flex justify-content-center">
                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-pink mx-3">Return to list</a>
                        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-transparent btn-edit mx-3">Edit details</a>
                    </li>
                </ul>
            </div>

            {{-- Messages --}}
            <div class="col-12 mt-4">
                <div class="m-3 text-center">
                    <a class="btn btn-pink position-relative" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Messages <i class="fa-solid fa-comments"></i> @if (count($messages) != 0)
                      <span class="badge badge-light text_danger badge-pill position-absolute badge-position fs-1">{{ count($messages) }}</span>    
                      @endif
                    </a>
                </div>
                @if (count($messages) != 0)
                    <div class="collapse bg-light p-3 border rounded scrollable-menu" id="collapseExample">
                        @foreach ($messages as $message)
                            <div class="text_danger border rounded p-3 mb-3 shadow"> 
                                <div class="text-dark mb-2">
                                        <strong class="text_danger"><i class="fa-solid fa-user"></i> From:</strong> <span class="ml-2">{{ $message->name }}</span>
                                </div>
                            
                                <div class="text-dark mb-2">
                                        <strong class="text_danger"><i class="fa-solid fa-envelope"></i> Email:</strong> <span class="ml-2">{{ $message->email }}</span> 
                                </div>
                            
                                <div class="d-flex mb-2">
                                        <span class="flex-shrink-0 mr-2"><strong class="text_danger"><i class="fa-solid fa-comment-dots"></i> Message:</strong></span>
                                        <span class="text-dark">{{ $message->message }}</span>
                                </div>
                            
                                <div class="text-dark mb-2">
                                        <strong class="text_danger"><i class="fa-solid fa-paper-plane"></i> Sended:</strong> <span class="ml-2">{{ $message->created_at }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="collapse bg-light p-3 border rounded text-center" id="collapseExample">
                        <h3> There is no message</h3>
                    </div>
                @endif
            </div>
          </div>
        </div>
    </div>
@endsection