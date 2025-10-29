@props(['dish'])

<div class="block text-white min-h-50 min-w-full p-6 bg-(--site-color-primary) border border-(--site-color-borders) border-4 rounded-sm shadow-sm">
    <p> {{ $dish->dish_name }}</p>
</div>