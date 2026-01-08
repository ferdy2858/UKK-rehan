<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hiking App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-gradient-to-br from-emerald-400 via-green-500 to-teal-600 relative overflow-hidden">

    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Mountains SVG Background -->
        <svg class="absolute bottom-0 w-full h-64 text-green-700 opacity-20" viewBox="0 0 1200 320"
            preserveAspectRatio="none">
            <path fill="currentColor" d="M0,160 L300,80 L600,160 L900,60 L1200,140 L1200,320 L0,320 Z"></path>
        </svg>
        <svg class="absolute bottom-0 w-full h-48 text-green-800 opacity-30" viewBox="0 0 1200 320"
            preserveAspectRatio="none">
            <path fill="currentColor" d="M0,200 L400,120 L800,180 L1200,100 L1200,320 L0,320 Z"></path>
        </svg>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-3 h-3 bg-white rounded-full animate-bounce opacity-60"
            style="animation-duration: 3s;"></div>
        <div class="absolute top-40 right-20 w-2 h-2 bg-white rounded-full animate-bounce opacity-50"
            style="animation-duration: 4s; animation-delay: 1s;"></div>
        <div class="absolute top-60 left-1/4 w-2 h-2 bg-white rounded-full animate-bounce opacity-70"
            style="animation-duration: 5s; animation-delay: 2s;"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 relative z-10">

        <!-- Header Badge -->
        <div class="mb-6 animate-fade-in">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md rounded-full border border-white/30 shadow-lg">
                <a href="/">
                    <span class="text-2xl">⛰️</span>
                    <span class="text-white font-bold text-sm tracking-wider">ADVENTURE AWAITS</span>
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="w-full sm:max-w-md animate-slide-up">
            <div class="relative">
                <!-- Decorative Corner Elements -->
                <div class="absolute -top-3 -left-3 w-6 h-6 border-t-4 border-l-4 border-emerald-300 rounded-tl-2xl">
                </div>
                <div class="absolute -top-3 -right-3 w-6 h-6 border-t-4 border-r-4 border-emerald-300 rounded-tr-2xl">
                </div>
                <div class="absolute -bottom-3 -left-3 w-6 h-6 border-b-4 border-l-4 border-emerald-300 rounded-bl-2xl">
                </div>
                <div
                    class="absolute -bottom-3 -right-3 w-6 h-6 border-b-4 border-r-4 border-emerald-300 rounded-br-2xl">
                </div>

                <div class="px-8 py-10 bg-white/95 backdrop-blur-xl shadow-2xl rounded-3xl border-2 border-emerald-200">

                    <!-- Logo Section -->
                    <div class="flex flex-col items-center mb-8">
                        <div class="relative mb-4">
                            <!-- Icon Circle -->
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-green-600 rounded-full flex items-center justify-center shadow-lg transform hover:scale-110 transition-transform duration-300">
                                <span class="text-4xl">🏔️</span>
                            </div>
                            <!-- Pulse Ring -->
                            <div class="absolute inset-0 w-20 h-20 bg-emerald-400 rounded-full animate-ping opacity-20">
                            </div>
                        </div>
                        <h1
                            class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600">
                            Hiking App
                        </h1>
                        <p class="text-green-700 text-sm mt-1 font-medium">Jelajahi Keindahan Alam</p>
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-green-300 to-transparent"></div>
                        <span class="text-green-600 text-xs font-semibold">LOGIN</span>
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-green-300 to-transparent"></div>
                    </div>

                    <!-- Form Slot -->
                    <div class="space-y-4">
                        {{ $slot }}
                    </div>

                    <!-- Footer -->
                    <div class="mt-8 pt-6 border-t border-green-200">
                        <div class="text-center">
                            <p class="text-green-800 font-semibold mb-2">Selamat datang di Hiking App 🌲</p>
                            <p class="text-green-600 text-xs">Mulai petualanganmu bersama kami</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bottom Info -->
        <div class="mt-6 flex items-center gap-4 text-white text-sm">
            <div class="flex items-center gap-1">
                <span>🥾</span>
                <span class="font-medium">Trek</span>
            </div>
            <span class="opacity-50">•</span>
            <div class="flex items-center gap-1">
                <span>🗺️</span>
                <span class="font-medium">Explore</span>
            </div>
            <span class="opacity-50">•</span>
            <div class="flex items-center gap-1">
                <span>🌄</span>
                <span class="font-medium">Discover</span>
            </div>
        </div>

    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.8s ease-out;
        }
    </style>
</body>

</html>
