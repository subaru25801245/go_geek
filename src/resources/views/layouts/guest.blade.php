<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/forum.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/forum.css') }}">
    <script src="{{ asset('js/custom.js') }}"></script>
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    <div class="w-full container mx-auto p-6">
        <div class="w-full flex items-center justify-between">
            <a href="{{route('top')}}"><img src="{{asset('logo/go_geek.png')}}"   style="max-height:100px;"></a>

        </div>
    <div class="w-full container mx-auto p-6">
        {{ $slot }}
    </div>
</div>
</body>
</html>
