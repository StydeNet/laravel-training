@extends('layout')

@section('content')
    <div class="container mx-auto border-md flex h-screen p-8 space-x-8">
        @include('home._code')
        <div class="flex-1 p-8 bg-gray-200 rounded-md">
            @include('home._form')
        </div>
    </div>
@endsection
