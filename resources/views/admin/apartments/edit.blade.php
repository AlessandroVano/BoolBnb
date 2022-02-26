@extends('layouts.app')
@section('content')
<div class="container text-white">
    <h1 class="mb-5">Edit {{ $apartment->name }}</h1>

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
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $apartment->name) }}">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  {{-- DESCRIPTION --}}
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" id="description"  class="form-control" value="{{old('description', $apartment->description) }}">
                    @error('description')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  {{-- PRICE --}}
                  <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price"  class="form-control" value="{{old('price', $apartment->price) }}">
                    @error('price')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- ROOMS --}}
                   <div class="mb-3">
                    <label for="rooms" class="form-label">Rooms</label>
                    <input type="number" name="rooms" id="rooms"  class="form-control" value="{{old('rooms', $apartment->rooms) }}">
                    @error('rooms')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- MAX PEOPLE --}}
                   <div class="mb-3">
                    <label for="max_people" class="form-label">Max people</label>
                    <input type="number" name="max_people"  class="form-control" id="max_people" value="{{old('max_people', $apartment->max_people) }}">
                    @error('max_people')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- BATHROOMS --}}
                     <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" name="bathrooms"  class="form-control" id="bathrooms" value="{{old('bathrooms', $apartment->max_people) }}">
                        @error('bathrooms')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                   {{-- SQUARE_METERS --}}
                   <div class="mb-3">
                    <label for="square_meters" class="form-label">Square meters</label>
                    <input type="number" name="square_meters"  class="form-control" id="square_meters" value="{{old('square_meters', $apartment->square_meters) }}">
                    @error('square_meters')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- LATITUDE --}}
                   <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="number" name="latitude"  class="form-control" id="latitude" value="{{old('latitude', $apartment->latitude) }}">
                    @error('latitude')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- LONGITUDINE --}}
                   <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="number"  class="form-control" name="longitude" id="longitude" value="{{old('longitude', $apartment->longitude) }}">
                    @error('longitude')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- IMMAGINE --}}
               <div class="mb-3">
                   <h4>Image apartment</h4>
                    <figure class="py-2">
                        @if (! $apartment->image)
                            <img width="200" src="{{ asset('storage/img-apartments/Not-found.png') }}" alt="{{$apartment->name}}">
                        @else
                            <div>Apartment image preview:</div>
                            <img width="200" src="{{ asset('storage/' . $apartment->image) }}" alt="{{$apartment->name}}">
                        @endif
                    </figure>

                    <label for="label-control" for="immage">Change/Upload apartment image:</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                    @error('image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
               </div>

               {{-- Services --}}
               <div class="mb-3">
                   <h4>Services</h4>
                    @foreach ($services as $service)
                        <span class="d-inline-block mr-3">
                            <input type="checkbox" name="services[]" id="service{{ $loop->iteration }}" value="{{ $service->id }}"
                                @if ($errors->any() && in_array($service->id, old('services')))
                                    checked
                                @elseif (!$errors->any() && $apartment->services->contains($service->id))
                                    checked
                                @endif>
                                
                            <label for="service{{ $loop->iteration }}">
                                {{ $service->name }}
                            </label>
                        </span>
                    @endforeach   
                    @error('services')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
               </div>
                {{-- VISIBILITA' --}}
                <div class="d-flex align-items-center py-3">
                    <label for="visibility" class="m-0 mr-2">Visibilità</label>
                    <input type="checkbox" name="visibility" id="visibility" @if (old('visibility', $apartment->visibility)) checked @endif>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
    
@endsection