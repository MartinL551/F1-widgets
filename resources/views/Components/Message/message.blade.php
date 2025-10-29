@props(['message'])

<div class="block text-white min-h-50 min-w-full p-6 bg-(--site-color-primary) border border-(--site-color-borders) border-4 rounded-sm shadow-sm">
    <p>{{ $message['message'] }}</p>
    <p>{{ $message['flag'] }}</p>
    <p>{{ $message['scope'] }}</p>
    <p>{{ $message['date'] }}</p>
</div>