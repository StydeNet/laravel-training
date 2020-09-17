@extends('layout')

@section('code')
    @include('user._code', ['view' => 'user._list', 'params' => compact('users'), 'blade' => true])
@endsection

@section('html')
    @include('user._code', ['view' => 'user._list', 'params' => compact('users')])
@endsection

@section('content')
    @include('user._list')
@endsection
