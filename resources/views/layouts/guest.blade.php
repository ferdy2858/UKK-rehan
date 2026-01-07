<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hiking App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-b from-green-200 to-green-400">
    <div class="min-h-screen flex flex-col justify-center items-center px-4">

        <!-- Card -->
        <div class="w-full sm:max-w-md px-8 py-6 bg-white/90 backdrop-blur-md shadow-xl rounded-2xl border border-green-700">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="/">
                    <img src="{{ asset('img/logo-removebg-preview.png') }}" alt="Logo Hiking" class="w-36">
                </a>
            </div>

            <!-- Form slot -->
            {{ $slot }}

            <!-- Footer -->
            <div class="mt-4 text-center text-green-800 font-medium">
                Selamat datang di Hiking App 🌲
            </div>

        </div>
    </div>
</body>
</html>
