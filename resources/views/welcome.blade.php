<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HikingApp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] dark:bg-[#1a1a1a] text-[#1b1b18] font-sans">
    <!-- Header -->
    <header class="w-full lg:max-w-4xl max-w-[335px] mx-auto flex justify-between items-center py-6 px-5 lg:px-0">
        <h1 class="text-2xl font-bold text-green-700 dark:text-green-400">🏔 HikingApp</h1>
        @if (Route::has('login'))
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-md bg-green-700 text-white hover:bg-green-600 dark:bg-green-400 dark:text-black dark:hover:bg-green-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-md border border-green-700 text-green-700 hover:bg-green-100 dark:text-green-400 dark:border-green-400 dark:hover:bg-green-900">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-green-700 text-white hover:bg-green-600 dark:bg-green-400 dark:text-black dark:hover:bg-green-300">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Hero Section -->
    <section class="relative w-full lg:max-w-4xl max-w-[335px] mx-auto mt-6 px-5 lg:px-0 flex flex-col items-center text-center">
        <img src="https://images.unsplash.com/photo-1508672019048-805c876b67e2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDJ8fG11bnRhaW4lMjBoaWtpbmd8ZW58MHx8fHwxNjI1MzY0MDA0&ixlib=rb-4.0.3&q=80&w=1080" alt="Mountain" class="w-full h-64 object-cover rounded-xl shadow-lg">
        <h2 class="mt-6 text-3xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Temukan Jalur Hiking Terbaik</h2>
        <p class="mt-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">Jelajahi pegunungan Indonesia dan nikmati pengalaman mendaki yang tak terlupakan.</p>
        <a href="#trails" class="mt-4 px-6 py-2 bg-green-700 text-white rounded-md hover:bg-green-600 dark:bg-green-400 dark:text-black dark:hover:bg-green-300 transition">Lihat Jalur Hiking</a>
    </section>

    <!-- Hiking Trails Section -->
    <section id="trails" class="mt-12 lg:mt-20 w-full lg:max-w-4xl max-w-[335px] mx-auto px-5 lg:px-0 grid gap-6 lg:grid-cols-2">
        <div class="bg-white dark:bg-[#161615] rounded-xl shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080&q=80" alt="Gunung Rinjani" class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#1b1b18] dark:text-[#EDEDEC]">Gunung Rinjani</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Jalur mendaki 3 hari, cocok untuk pendaki menengah.</p>
            </div>
        </div>
        <div class="bg-white dark:bg-[#161615] rounded-xl shadow-lg overflow-hidden">
            <img src="{{ asset('img/051644500_1437558393-20150722-Gunung-berstatus-waspada-Indonesia-Gunung-Semeru.jpg') }}" alt="Gunung Semeru" class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#1b1b18] dark:text-[#EDEDEC]">Gunung Semeru</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Pendakian 2-3 hari, pemandangan sunrise yang menakjubkan.</p>
            </div>
        </div>
        <div class="bg-white dark:bg-[#161615] rounded-xl shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1080&q=80" alt="Gunung Bromo" class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#1b1b18] dark:text-[#EDEDEC]">Gunung Bromo</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Jalur mudah, cocok untuk pemula dan wisata keluarga.</p>
            </div>
        </div>
        <div class="bg-white dark:bg-[#161615] rounded-xl shadow-lg overflow-hidden">
            <img src="{{ asset('img/Gunung-Ijen.jpeg') }}" alt="Gunung Ijen" class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-lg text-[#1b1b18] dark:text-[#EDEDEC]">Gunung Ijen</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">Terkenal dengan kawah biru, jalur pendek dan menantang.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-16 w-full lg:max-w-4xl max-w-[335px] mx-auto text-center text-sm text-[#706f6c] dark:text-[#A1A09A] py-6">
        &copy; {{ date('Y') }} HikingApp. All rights reserved.
    </footer>
</body>
</html>
