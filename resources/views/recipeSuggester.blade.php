
@extends('layouts.app')


@section('content')
    <h1>{{ 'Recipe Suggester' }} </h1>
    <h2>{{ $race->race_country_name }} </h2>
    <h2>{{ $race->race_name }} </h2>
 

    
    <div class="grid place-items-center grid-cols-3 md:grid-cols-3 gap-4">
        @foreach ($dishes as $dish)
            <div class="block text-white min-h-50 min-w-full p-6 bg-(--site-color-primary) border border-(--site-color-borders) border-4 rounded-sm shadow-sm">
                <p> {{ $dish->dish_name }}</p>
            </div>
        @endforeach
    </div>

    {{-- @vite('resources/js/recipies/suggester.js') --}}
@stop

