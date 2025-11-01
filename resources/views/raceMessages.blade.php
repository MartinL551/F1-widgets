@extends('layouts.app')

@section('content')
    <h1>{{ 'Live Race Control Messages' }} </h1>

    <div class="grid place-items-center grid-cols-1 gap-4 race-control-messages" data-length="{{ count($messages) - 1 }}">
        @foreach ($messages as $message)
            <x-message :message="$message" :index="$loop->index" />
        @endforeach
    </div>
@stop

 @vite('resources/js/racecontrol/racecontrol.js')