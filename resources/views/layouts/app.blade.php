<!DOCTYPE html>
<html>
    <head>
        <title>Task List</title>
        @yield('styles')
    </head>
    <body>
        <h1>@yield('title')</h1>

        @if (session() -> has('success'))
                <p>{{ session('success') }}</p>
        @endif

        <div>
            @yield('content')
        </div>
    </body>
</html>