@extends('layouts.app')

@section('content')
    <h1>{{ 'Calendar' }} </h1>
    @foreach($races as $race)
        <div>
            <h2>{{ $race['meeting_name'] }}</h2>
            <p>Date: {{ $race['date_start'] }}</p>
            <p>Circuit: {{ $race['circuit_short_name'] }}</p>
        </div>
    @endforeach
@stop