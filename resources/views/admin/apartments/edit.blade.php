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
                    <label for="name" class="form-label">Name*</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $apartment->name) }}" required autocomplete="name" autofocus>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  {{-- DESCRIPTION --}}
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" name="description" id="description"  class="form-control" row="6">{{old('description', $apartment->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  {{-- PRICE --}}
                  <div class="mb-3">
                    <label for="price" class="form-label">Price for a night</label>
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
                   {{-- ADDRESS --}}
                   <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{old('address', $apartment->address) }}">
                    @error('address')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                   {{-- IMMAGINE --}}
               <div class="mb-3">
                   <h4>Image apartment</h4>
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

               {{-- Services --}}
               <div class="mb-3 container">
                   <h4>Services</h4>
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

               {{-- VISIBILITA' --}}
                <div class="d-flex align-items-center py-3">
                    <label for="visibility" class="m-0 mr-2">Visibility</label>
                    <input type="checkbox" name="visibility" id="visibility" @if (old('visibility', $apartment->visibility)) checked @endif>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
    
@endsection