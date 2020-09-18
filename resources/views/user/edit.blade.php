@extends('layout')

@section('code')
    @include('user._code', ['view' => 'user._edit-form', 'params' => ['user' => $user] ,'blade' => true])
@endsection

@section('html')
    @include('user._code', ['view' => 'user._edit-form', 'params' => ['user' => $user]])
@endsection

@section('content')
    <div class="flex-1 h-full p-8 bg-gray-200 rounded-md">
        <div class="max-w-xl mx-auto">
            @include('user._edit-form')
        </div>
    </div>
@endsection
