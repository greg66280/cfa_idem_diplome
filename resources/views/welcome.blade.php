@extends("layouts.default")

@section("content")

    <p class="text-black">Bienvenue, {{ auth()->user()->name }}</p>
    
@endsection