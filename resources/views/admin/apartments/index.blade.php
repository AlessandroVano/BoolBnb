@extends('layouts.app')

@section('content')

<h1 class="text-center my-5">I tuoi Appartamenti</h1>

<div class="container">
    @if (session('deleted'))
            <div class="alert alert-success">
                <strong>
                    {{ session('deleted') }}
                </strong>
                    Cancellato Con Successo
            </div>
        @endif
    <div class="row">
        @foreach ($apartments as $apartment )

        <div class="col border p-1 mx-2">
            <h3 class="text-center">{{$apartment->name}}</h3>

            <div class=" text-center img-container">
                <img src="{{$apartment->image}}" alt="{{$apartment->name}}">
            </div>
            <div class=" p-1 text-center detail-container my-3">
                <h5>
                    @if($apartment->visibility)
                        Apartment Available
                    @else Apartment NOT Available
                    @endif
                </h5>
                <div class="actions d-flex justify-content-around ">

                    <button class="btn btn-success">
                        <a class="text-decoration-none text-white"
                        href="{{route('admin.apartments.show', $apartment->id)}}">View Details</a>
                    </button>
                    
                    <form action="{{route('admin.apartments.destroy', $apartment->id)}}" method="POST">
                        
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="btn btn-danger">Delete Apartment</button>
                        
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection