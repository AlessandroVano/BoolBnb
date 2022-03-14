@extends('layouts.app')
@section('content')
<div class="container text-white">
    <h1 class="mb-5 text-center">Edit <i class="fa-solid fa-pen-to-square mx-2"></i> {{ $apartment->name }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error )
                <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>

    @endif
    <div class="row">
        <div class="col-12">
             <form action="{{route('admin.apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                {{-- NAME --}}
                <div class="mb-3">
                    <label for="name" class="form-label text-pink"><i class="fa-solid fa-signature mr-2 text-white"></i>Name*</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $apartment->name) }}" required autocomplete="name" autofocus>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  {{-- DESCRIPTION --}}
                  <div class="mb-3">
                    <label for="description" class="form-label text-pink"><i
                        class="fa-solid fa-rectangle-list mr-2 text-white"
                    ></i>Description</label>
                    <textarea type="text" name="description" id="description"  class="form-control" row="6">{{old('description', $apartment->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                {{-- ROOMS --}}
                <div class="mb-3">
                    <label for="rooms" class="form-label text-pink"><i
                        class="fa-solid fa-door-closed mr-2 text-white"
                    ></i
                    >Rooms*</label>
                    <input type="number" min="0" name="rooms" id="rooms"  class="form-control" value="{{old('rooms', $apartment->rooms) }}" required>
                    @error('rooms')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  {{-- PRICE --}}
                <div class="mb-3">
                    <label for="price" class="form-label text-pink"><i
                        class="fa-solid fa-money-bill-wave mr-2 text-white"
                    ></i>Price per night*</label>
                    <input type="number" min="0" name="price" id="price"  class="form-control" value="{{old('price', $apartment->price) }}" required>
                    @error('price')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- MAX PEOPLE --}}
                   <div class="mb-3">
                    <label for="max_people" class="form-label text-pink"><i class="fa-solid fa-users mr-2 text-white"></i>Max people</label>
                    <input type="number" min="0" name="max_people"  class="form-control" id="max_people" value="{{old('max_people', $apartment->max_people) }}">
                    @error('max_people')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- BATHROOMS --}}
                     <div class="mb-3">
                        <label for="bathrooms" class="form-label text-pink"><i class="fa-solid fa-bath mr-2 text-white"></i>Bathrooms*</label>
                        <input type="number" min="0" name="bathrooms"  class="form-control" id="bathrooms" value="{{old('bathrooms', $apartment->max_people) }}" required>
                        @error('bathrooms')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                   {{-- SQUARE_METERS --}}
                   <div class="mb-3">
                    <label for="square_meters" class="form-label text-pink"><i
                        class="fa-solid fa-border-top-left mr-2 text-white"
                    ></i>Square meters*</label>
                    <input type="number" min="0" name="square_meters"  class="form-control" id="square_meters" value="{{old('square_meters', $apartment->square_meters) }}" required>
                    @error('square_meters')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                {{-- ADDRESS --}}
                <div id="searchbar" class="mb-4">
                    <label for="address" class="form-label text-pink"><i
                        class="fa-solid fa-location-dot mr-2 text-white"
                    ></i>Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{old('address', $apartment->address)}}">
                    {{-- SUGGESTIONS --}}
                    <ul id="list" class="list-unstyled bg-white text-dark">
                    </ul>
                </div>

                {{-- LATITUDE --}}
                <label for="latitude" class="form-label" hidden>Latitude</label>
                <input
                    value="{{old('address', $apartment->latitude)}}"
                    type="text"
                    class="form-control"
                    name="latitude"
                    id="latitude"
                    hidden
                />
                <!-- LONgitude -->
                <label for="longitude" class="form-label" hidden>Longitude</label>
                <input
                    value="{{old('address', $apartment->longitude)}}"
                    type="text"
                    class="form-control"
                    name="longitude"
                    id="longitude"
                    hidden
                />

                {{-- IMMAGINE --}}
                <div class="my-4">
                    <h4><i class="fa-solid fa-panorama mr-2"></i>Image apartment</h4>
                    <figure class="py-2">
                        @if (! $apartment->image)
                            <img width="200" src="{{ asset('storage/img-apartments/Not-found.png') }}" alt="{{$apartment->name}}" class="rounded">
                        @else
                            <div>Apartment image preview:</div>
                            <img width="200" src="{{ asset('storage/' . $apartment->image) }}" alt="{{$apartment->name}}" class="rounded">
                        @endif
                    </figure>

                    <label for="label-control" for="immage">Change/Upload apartment image:</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                    @error('image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

               {{-- VISIBILITY --}}
               <div class="mb-4">
                   <h4><i class="fa-solid fa-eye mr-2"></i>Visibility</h4>
                   <div class="mb-3 custom-control custom-switch">
                        <input class="custom-control-input" type="checkbox" id="visibility" name='visibility' value="1" @if ( old("visibility")|| $apartment->visibility )
                            checked  
                        @endif>
                        <label class="custom-control-label" for="visibility">Visibility</label>
                    </div>
               </div>
               
               {{-- Services --}}
               <div>
                   <h4><i class="fa-solid fa-list mr-2"></i>Services</h4>
                   <div class="mb-3 container">
                       <div class="row">
                           @foreach ($services as $service)
                               <div class="custom-control custom-switch col-4">
                                   <input class="custom-control-input" type="checkbox" name="services[]" id="customSwitch{{ $loop->iteration }}" value="{{ $service->id }}"
                                       @if ($errors->any() && in_array($service->id, old('services')))
                                           checked
                                       @elseif (!$errors->any() && $apartment->services->contains($service->id))
                                           checked
                                       @endif>
                                       
                                   <label class="custom-control-label" for="customSwitch{{ $loop->iteration }}">
                                       {{ $service->name }}
                                   </label>
                               </div>
                           @endforeach
                       </div>
                        @error('services')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                   </div>
               </div>

                <div class="text-right mt-3">
                    <span class="fs-3">All fields marked with * are <strong>mandatory</strong></span>
                </div>

                <button type="submit" class=" align-self-center btn btn-transparent">Confirm</button>
            </form>
        </div>
    </div>
</div>
    
@endsection