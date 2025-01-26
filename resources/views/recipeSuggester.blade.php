<html>
    @vite('resources/css/app.css')
    <body>
        <h1 class="text-3xl font-bold underline">{{ 'Recipe Suggester' }} </h1>
    </body>
    
    {{ dump($dishes) }}
    @foreach ($dishes as $dish)
        <p> {{ $dish->dish_name }}</p>
    @endforeach


    @vite('resources/js/recipies/suggester.js')
</html>