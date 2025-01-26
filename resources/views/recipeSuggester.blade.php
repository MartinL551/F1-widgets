<html>
    <body>
        <h1>{{ 'Recipe Suggester' }} </h1>
    </body>
    
    {{ dump($dishes) }}
    @foreach ($dishes as $dish)
        <p> {{ $dish->dish_name }}</p>
    @endforeach


    @vite('resources/js/recipies/suggester.js')
</html>