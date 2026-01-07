<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HikingApp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-b from-green-100 to-green-300">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white/90 backdrop-blur-md border-r border-green-700 shadow-lg hidden md:flex flex-col">

            <!-- Logo -->
            <div class="px-6 py-5 flex items-center gap-2 text-green-700 font-bold text-xl">
                🏔 HikingApp
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 space-y-2">
                @include('layouts.navigation')
            </nav>

            <!-- Footer sidebar -->
            <div class="px-6 py-4 text-sm text-green-800">
                © {{ date('Y') }} HikingApp
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/90 backdrop-blur-md shadow-md border-b border-green-700">
                    <div class="px-6 py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
