@extends('layouts.app')

@section('content')

<h1 class="text-center text-white my-5">Your Apartments <i class="fa-solid fa-city ml-2"></i></h1>

@if (!$apartments->count() == 0)
<div class="container bg-dark text-white">
    @if (session('deleted'))
        <div class="alert alert-success">
            <strong>
                {{ session('deleted') }}
            </strong>
                Deleted Successfully!
        </div>
    @endif
    @if (session('deleted-message'))
        <div class="alert alert-success">
            <strong>
                {{ session('deleted-message') }}'s
            </strong>
            message has been deleted successfully!
        </div>
    @endif
    <div class="row justify-content-center justify-content-md-start">
        @foreach ( $apartments as $apartment )

        <div class=" col-11 col-md-6 col-lg-4 my-3">
            <div class="card-container rounded border p-2 mx-2">
                @if ($apartment->sponsorship == 1)
                    <div class="card-subtitle mb-2">
                        <i class="fa-solid fa-medal medal-icon"></i>
                    </div>
                @endif
                <h3 class="text-center mt-1">{{$apartment->name}}</h3>

                <div class="text-center img-container">
                    @if (! $apartment->image)
                        <img class="rounded img-apartment" src="{{ asset('storage/img-apartments/Not-found.png') }}" alt="{{$apartment->name}}">
                    @else
                        <img class="rounded img-apartment"src="{{ asset('storage/' . $apartment->image) }}" alt="{{$apartment->name}}">
                    @endif
                </div>
                <div class="p-1 text-center detail-container my-3">
                    <h5>
                        @if($apartment->visibility)
                            <span>Apartment Available</span>
                            <img class="icon invert" src="{{ asset('storage/icon/Visible.png') }}" alt="Visibility Icon">
                        @else 
                            <span>Apartment NOT Available</span>
                            <img class="icon invert" src="{{ asset('storage/icon/Not-visible.png') }}" alt="Not Visibility Icon">
                        @endif
                    </h5>
                    <div class="actions ">

                        <div class="mx-auto d-flex justify-content-around">
                            <button class="b-custom btn btn-success">
                                <a class="text-decoration-none text-white"
                                href="{{route('admin.apartments.show', $apartment->slug)}}">View<i class="fa-solid fa-door-open ml-2 hover-door d-none"></i><i class="fa-solid hover-door-2 fa-door-closed ml-2"></i></a>
                            </button>
                            
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#exampleModal{{$apartment->id}}">
                                Delete <i class="fa-solid fa-trash-can ml-1"></i>
                            </button>
                        </div>
                        <form action="{{route('admin.apartments.destroy', $apartment->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                            <div
                                class="modal fade text-danger"
                                id="exampleModal{{ $apartment->id }}"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Warning<i class="fa-solid fa-triangle-exclamation ml-2"></i>
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
                                        <div class="modal-body">Are you sure that you want to delete this apartment?</div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">
                                                Delete <i class="fa-solid fa-trash-can"></i> 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<h3 class="text-center text-white my-10">There's no apartment, start from here to <a class="text-pink add-one"href="{{ route('admin.apartments.create') }}">add one</a></h3>
@endif

@endsection