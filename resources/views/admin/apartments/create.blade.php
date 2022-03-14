@extends('layouts.app')

@section('content')
    <section class="container text-white">
        <h1 class="text-center">Add your apartment <i class="fa-solid fa-house-medical ml-2"></i></h1>
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

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fa-solid fa-signature mr-2"></i>Name*</label>
                <input type="text" class="form-control" name='name' id="name" value="{{ old('name') }}" required> 
                @error('name')
                    <div class="text_danger">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label"><i
                    class="fa-solid fa-rectangle-list mr-2"
                ></i> Description </label>
                <textarea class="form-control" name='description' id="description" row="6">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Rooms --}}
            <div class="mb-3">
                <label for="rooms" class="form-label"><i
                    class="fa-solid fa-door-closed mr-2"
                ></i
                >Rooms* </label>
                <input type="number" min="1" class="form-control" name='rooms' id="rooms" value="{{ old('rooms') }}" required>
                @error('rooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label"><i
                    class="fa-solid fa-money-bill-wave mr-2"
                ></i>Price per night*</label>
                <input type="number" min="1" class="form-control" name='price' id="price" value="{{ old('price') }}" required>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Max people --}}
            <div class="mb-3">
                <label for="max_people" class="form-label"><i class="fa-solid fa-users mr-2"></i>Max people</label>
                <input type="number" min="0" class="form-control" name='max_people' id="max_people" value="{{ old('max_people') }}">
                @error('max_people')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Bathrooms --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label"><i class="fa-solid fa-bath mr-2"></i>Bathrooms*</label>
                <input type="number" min="0" class="form-control" name='bathrooms' id="bathrooms" value="{{ old('bathrooms') }}" required>
                @error('bathrooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Square meters --}}
            <div class="mb-3">
                <label for="square_meters" class="form-label"><i
                    class="fa-solid fa-border-top-left mr-2"
                ></i>Square meters*</label>
                <input type="number" min="0" class="form-control" name='square_meters' id="square_meters" value="{{ old('square_meters') }}" required>
                @error('square_meters')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Address --}}
            <div id="searchbar" class="mb-3">
                <label for="address" class="form-label"><i
                    class="fa-solid fa-location-dot mr-2"
                ></i>Address</label>
                <input type="text" id="address" name="address" class="form-control">
                {{-- Suggestions --}}
                <ul id="list" class="list-unstyled bg-white text-dark">
                </ul>
            </div>
            
            {{-- Latitude --}}
            <label for="latitude" class="form-label" hidden>Latitude</label>
            <input
                type="text"
                class="form-control"
                name="latitude"
                id="latitude"
                hidden
            />
            <!-- Longitude -->
            <label for="longitude" class="form-label" hidden>Longitude</label>
            <input
                type="text"
                class="form-control"
                name="longitude"
                id="longitude"
                hidden
            />

            <div class="text-right mt-2">
                <span class="fs-3">All fields marked with * are <strong>mandatory</strong></span>
            </div>

            {{-- Image --}}
            <div class="my-4">
                <h4><i class="fa-solid fa-panorama mr-2"></i>Image apartment</h4>
                <label for="image" class="form-label">Upload an image</label>
                <input type="file" class="form-control-file" name="image" id="image">
                @error('image')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- Visibility --}}
            <div class="my-3">
                <h4><i class="fa-solid fa-eye mr-2"></i>Visibility</h4>
                <div class="mb-3 custom-control custom-switch">
                    <input class="custom-control-input" type="checkbox" id="visibility" name='visibility' value="1" @if (old("visibility"))
                        checked  
                    @endif>
                    <label class="custom-control-label" for="visibility">Visibility</label>
                </div>
            </div>

            {{-- Services --}}
            <div>
                <h4><i class="fa-solid fa-list mr-2"></i>Services</h4>
                <div class="mb-3">
                    <div class="row">
                    @foreach ($services as $service)
                        <div class="custom-control custom-switch col-4">
                            <input class="custom-control-input" 
                                type="checkbox" 
                                name="services[]" 
                                id="customSwitch{{ $loop->iteration }}"
                                value="{{ $service->id }}"
                                @if (in_array($service->id, old('services', [] ))) checked @endif>
                            <label class="custom-control-label" for="customSwitch{{ $loop->iteration }}">{{ $service->name }}</label>
                        </div>
                    @endforeach
                    </div>
                    @error('services')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class="btn btn-transparent align-self-center mt-4" type="submit">Add your new apartment</button>

        </form>

    </section>
    
@endsection