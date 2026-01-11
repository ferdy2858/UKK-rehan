<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HikingApp') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-b from-green-100 to-green-300 overflow-hidden">
    <div class="h-screen flex">

        <!-- Sidebar (FIXED HEIGHT, NO SCROLL PAGE) -->
        <aside class="w-64 bg-white/90 backdrop-blur-md border-r border-green-700 shadow-lg hidden md:flex flex-col">

            <!-- Logo -->
            <div class="px-6 py-5 flex items-center gap-2 text-green-700 font-bold text-xl shrink-0">
                🏔 HikingApp
            </div>

            <!-- Navigation -->
            <div class="flex-1 overflow-hidden">
                @include('layouts.navigation')
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 text-sm text-green-800 shrink-0">
                © {{ date('Y') }} HikingApp
            </div>
        </aside>

        <!-- Main Area -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Header -->
            @isset($header)
                <header class="bg-white/90 backdrop-blur-md shadow-md border-b border-green-700 shrink-0">
                    <div class="px-6 py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- ✅ ONLY THIS SCROLLS -->
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>


</html>
