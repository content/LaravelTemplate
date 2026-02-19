<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    
    <title>@yield('title', 'Default Title')</title>
</head>
<body>
    <div class="container-fluid">
        @include('components.header')
        <div class="container">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>