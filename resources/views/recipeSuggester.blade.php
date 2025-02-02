
@extends('layouts.app')


@section('content')
    <h1 class="text-3xl font-bold underline red">{{ 'Recipe Suggester' }} </h1>
    
    @foreach ($dishes as $dish)
        <p> {{ $dish->dish_name }}</p>
    @endforeach

    {{-- @vite('resources/js/recipies/suggester.js') --}}
@stop

