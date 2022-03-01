@extends('layouts.app')

@section('content')
    <section class="container text-white">
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

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="">Name</label>
                <input type="text" class="" name='name' id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text_danger">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name='description' id="description" row="6">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Rooms --}}
            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="number" class="form-control" name='rooms' id="rooms" value="{{ old('rooms') }}">
                @error('rooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name='price' id="price" value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Max people --}}
            <div class="mb-3">
                <label for="max_people" class="form-label">Max people</label>
                <input type="number" class="form-control" name='max_people' id="max_people" value="{{ old('max_people') }}">
                @error('max_people')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Bathrooms --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="number" class="form-control" name='bathrooms' id="bathrooms" value="{{ old('bathrooms') }}">
                @error('bathrooms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Square meters --}}
            <div class="mb-3">
                <label for="square_meters" class="form-label">Square meters</label>
                <input type="number" class="form-control" name='square_meters' id="square_meters" value="{{ old('square_meters') }}">
                @error('square_meters')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Address --}}
            {{-- <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name='address' id="address" value="{{ old('address') }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            <Search>
            </Search>
            {{-- <div class="map-view">
                <div class="tt-side-panel">
                  <header class="tt-side-panel__header"></header>
                  <div class="tt-tabs js-tabs">
                    <div class="tt-tabs__panel">
                      <div class="js-results" hidden="hidden"></div>
                      <div class="js-results-loader" hidden="hidden">
                        <div class="loader-center"><span class="loader"></span></div>
                      </div>
                      <div class="tt-tabs__placeholder js-results-placeholder"></div>
                    </div>
                  </div>
                </div>
                <div id="map" class="full-map"></div>
              </div> --}}


            {{-- Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Uploade an image</label>
                <input type="file" class="form-control-file" name="image" id="image">
                @error('image')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            {{-- Visibility --}}
            <div class="mb-3">
                <label for="visibility" class="form-label">Visibility</label>
                <input type="checkbox" name='visibility' id="visibility" value="{{ old('visibility') }}">
            </div>

            {{-- Services --}}
            <div class="mb-3">
                <h4>Services</h4>
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

            <button class="btn btn-primary align-self-center w-25" type="submit">Add your new apartment</button>

        </form>
    </section>
@endsection