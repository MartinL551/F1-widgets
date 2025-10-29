
@extends('layouts.app')


@section('content')
    <h1>{{ 'Recipe Suggester' }} </h1>
    <h2>{{ $race->race_country_name }} </h2>
    <h2>{{ $race->race_name }} </h2>
 

    
    <div class="grid place-items-center grid-cols-3 md:grid-cols-3 gap-4">
        @foreach ($dishes as $dish)
            <x-dish :dish="$dish" />
        @endforeach
    </div>

    {{-- @vite('resources/js/recipies/suggester.js') --}}
@stop

