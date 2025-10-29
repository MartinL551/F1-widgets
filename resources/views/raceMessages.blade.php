@extends('layouts.app')

@section('content')
    <h1>{{ 'Live Race Control Messages' }} </h1>

    <div class="grid place-items-center grid-cols-1 gap-4">
        @foreach ($messages as $message)
            <x-message :message="$message" />
        @endforeach
    </div>
@stop