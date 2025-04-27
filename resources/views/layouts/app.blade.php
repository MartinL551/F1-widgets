<!doctype html>
<html>
<head>
    @include('partials.head')
</head>
<body>
<div>
    <header>
        @include('partials.header')
    </header>
    <main>
            @yield('content')
    </main>
    <footer class="w-full flex justify-center fixed bottom-0">
        @include('partials.footer')
    </footer>
</div>
</body>
</html>