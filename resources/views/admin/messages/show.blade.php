@extends('layouts.app')

@section('content')

    <h1 class="text-center text-white my-5 text_danger">Aparments Messages</h1>
    @foreach ($messages as $message)
        <div>{{ $message->name }}</div>
        <div>{{ $message->email }}</div>
        <div>{{ $message->message }}</div>
    @endforeach
@endsection