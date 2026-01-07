<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="icon" type="image/webp" href="{{ asset('images/favicon.webp') }}">
        <link rel="shortcut icon" type="image/webp" href="{{ asset('images/favicon.webp') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/favicon.webp') }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="antialiased">
        @inertia
    </body>
</html>
