@extends('layout')

@section('content')
    <div class="container mx-auto border-md h-screen p-8 flex flex-col" x-data="{active: 'form'}">
        <div class="flex mb-4">
            <label x-on:click="active = 'form'" x-bind:class="{'bg-blue-300 text-blue-900': (active === 'form')}" class="cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 rounded-md">Form</label>
            <label x-on:click="active = 'blade'" x-bind:class="{'bg-blue-300 text-blue-900': (active === 'blade')}" class="cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 rounded-md ml-4">Blade</label>
            <label x-on:click="active = 'html'" x-bind:class="{'bg-blue-300 text-blue-900': (active === 'html')}" class="cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 rounded-md ml-4">Html</label>
        </div>
        <div class="flex-1 w-full" x-cloak x-show="active === 'form'">
            <div class="flex-1 h-full p-8 bg-gray-200 rounded-md">
                <div class="max-w-xl mx-auto">
                    @include('home._form')
                </div>
            </div>
        </div>
        <div class="w-full h-full" x-cloak x-show="active === 'blade'">
            @include('home._code', ['blade' => true])
        </div>
        <div class="w-full h-full" x-cloak x-show="active === 'html'">
            @include('home._code')
        </div>
    </div>
@endsection
