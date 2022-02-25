@extends('layouts.app')

@section('content')
    <section class="container">
        <h1>Add your apartment</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="d-flex flex-column" action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name='name' id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name='description' id="description" row="6">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="number" class="form-control" name='rooms' id="rooms" value="{{ old('rooms') }}">
                @error('rooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" name='price' id="price" value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="max_people" class="form-label">Max people</label>
                <input type="text" class="form-control" name='max_people' id="max_people" value="{{ old('max_people') }}">
                @error('max_people')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="text" class="form-control" name='bathrooms' id="bathrooms" value="{{ old('bathrooms') }}">
                @error('bathrooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Square meters</label>
                <input type="text" class="form-control" name='square_meters' id="square_meters" value="{{ old('square_meters') }}">
                @error('square_meters')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" name='latitude' id="latitude" value="{{ old('latitude') }}">
                {{-- @error('latitude')
                    <div class="text-danger">{{ $message }}</div>
                @enderror --}}
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" name='longitude' id="longitude" value="{{ old('longitude') }}">
                {{-- @error('longitude')
                    <div class="text-danger">{{ $message }}</div>
                @enderror --}}
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Url image</label>
                <input type="text" class="form-control" name='image' id="image" value="{{ old('image') }}">
            </div>

            <div class="mb-3">
                <label for="visibility" class="form-label">Visibility</label>
                <input type="checkbox" name='visibility' id="visibility" value="{{ old('visibility') }}">
            </div>

          
            <div class="mb-3">
                <h4>services</h4>
                
                @foreach ($services as $service)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox" name="services[]" id="service{{ $loop->iteration }}" value="{{ $service->id }}"
                            @if (in_array($service->id, old('services', [] ))) checked @endif>
                            
                        <label for="service{{ $loop->iteration }}">
                            {{ $service->name }}
                        </label>
                    </span>
                @endforeach   
                @error('services')
                    <div class="text-danger">{{ $message }}</div>
                @enderror              
            </div> 

            <button class="btn btn-primary align-self-center w-25" type="submit">Add your new apartment</button>

        </form>
    </section>
@endsection