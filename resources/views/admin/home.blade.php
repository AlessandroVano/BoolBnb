@extends('layouts.app')

@section('content')
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-12">
            <div class="card mt-5 text-center">
                <div class="card-header">
                    <h1>Welcome to <i class="fa-regular fa-user"></i> {{ Auth::user()->name }}'s dashboard</h1>
                    <h4>Your user ID is {{ Auth::id() }} <i class="fa-solid fa-id-card"></i></h4>
                </div>

                <div class="card-body">
                    <h2 class="mt-3">What to do now? <br>
                        <a class="dash-hover text-pink mr-4"
                            href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-angles-right my-2 mr-2"></i>View
                        </a>
                        <a class="dash-hover text-pink mr-4"
                            href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-angles-right my-2 mr-2"></i>Create
                        </a> (and more...) <br>
                        your apartments
                    </h2>
                    @if ($apartments->count() > 0)
                       <h2 class="text-pink">Actually you have {{ $apartments->count() }} <i class="fa-solid fa-house"></i></h2>
                    @else
                        <h3>Do you want to become a host? <a class="text-pink dash-hover ml-3" href="{{ route('admin.apartments.create') }}">Create your first apartment</a></h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection