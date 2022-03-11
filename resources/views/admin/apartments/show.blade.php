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
            <div class="col-sm-12 col-md-6 my-4 align-self-start text-center">
                @if (! $apartment->image)
                    <img class="img-fluid rounded" src="{{ asset('storage/img-apartments/Not-found.png') }}" alt="{{ $apartment->name }}">
                @else
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->name }}">
                @endif
            </div>
            <div class="col-sm-12 col-md-6">
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
                            <strong>Something about: </strong> <br> {{ $apartment->description }}
                        </li>
                    @endif
                    {{-- Geography position --}}
                    <li class="list-group-item">
                        <img class="icon" src="{{ asset('storage/icon/Geography.png') }}" alt="Geography's icon">
                        @if ( $apartment->address )
                            <strong>Address: </strong> {{ $apartment->address }}
                        @else
                            <strong>Address not specified </strong>
                        @endif
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
                        <a class="btn btn-pink mx-2" href="{{ route('admin.sponsorships.show', $apartment->id) }}">Sponsor Your Apartment</a>
                    </li>
                </ul>
            </div>

            {{-- Messages --}}
            <div class="col-12 mt-4">
                <div class="m-3 text-center">
                    <a class="btn btn-pink position-relative w-25" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Messages <i class="fa-solid fa-comments"></i> @if (count($messages) != 0)
                      <span class="badge badge-light text_danger badge-pill position-absolute badge-position fs-1">{{ count($messages) }}</span>    
                      @endif
                    </a>
                </div>
                @if (count($messages) != 0)
                    <div class="collapse bg-light p-3 border rounded" id="collapseExample">
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

                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#exampleModal{{$message->id}}">
                                                Delete Message <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        <form action="{{ route('admin.messages.destroy', [$message->id, $apartment->slug])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div
                                                    class="modal fade text-danger"
                                                    id="exampleModal{{ $message->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                         <h5 class="modal-title" id="exampleModalLabel">
                                                            Warning <i class="fa-solid fa-circle-exclamation"></i>
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"
                                                        >
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">Are you sure  that you want to permanently delete this message?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">
                                                            Delete message <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="collapse bg-light p-3 border rounded text-center" id="collapseExample">
                        <h1>The message's box is empty</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection