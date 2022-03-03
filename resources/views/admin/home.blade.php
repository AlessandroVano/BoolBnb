@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Welcome to {{ Auth::user()->name }}'s dashboard</h1>
                    <h4>Your user ID is {{ Auth::id() }}</h4>
                </div>

                <div class="card-body">
                    <h2 class="mt-3">What to do now? Choose, edit or check your amazing apartments</h2>
                    @if ($apartments->count() > 0)
                        <h3><a href="{{ route('admin.apartments.index') }}">Go to your apartments, actually you have {{ $apartments->count() }}</a></h3>
                    @else
                        <h3>Do you want to become a host? <a href="{{ route('admin.apartments.create') }}">Create your first apartment</a></h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
