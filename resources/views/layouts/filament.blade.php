<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Admin Panel</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body>
<div class="filament">
    @yield('content')
</div>
@stack('scripts')
</body>
</html>
