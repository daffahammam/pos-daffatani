<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/daffatani.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <!-- Card with Logo and Content -->
        <div class="w-full sm:max-w-md bg-white shadow-md rounded-lg px-6">
            <!-- Logo -->
            <div class="flex justify-center">
                <a href="/">
                    <x-application-logo class=" w-auto fill-current text-green-600" />
                </a>
            </div>

            <!-- Form / Slot Content -->
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>

</body>
</html>
