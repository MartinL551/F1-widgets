
@extends('layouts.app')


@section('content')
<div>
    <h1>Header 1</h1>
    <h2>Header 2</h2>\
    <h3>Header 3</h3>
    <h4>Header 4</h4>
    <h5>Header 5</h5>
    <h6>Header 6</h6>
    <p>Paragraphy Text</p>
    <a href="#">Link Styling</a>
    <button>Default Button</button>
<div>

<div>
    <h3> Site Colours </h3>
    <div class="grid grid-cols-5">
        <div class="bg-(--site-color-primary) w-[150px] h-[150px]">Primary</div>
        <div class="bg-(--site-color-secondary) w-[150px] h-[150px]">Secondary</div>
        <div class="bg-(--site-color-tertiary) w-[150px] h-[150px]">Tertiary</div>
        <div class="border-(--site-color-borders) border-4 w-[150px] h-[150px]">Border</div>
    </div>
</div>
@stop

