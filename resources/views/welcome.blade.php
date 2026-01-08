<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HikingApp - Pemesanan Tiket Hiking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.2);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-emerald-50 dark:from-gray-900 dark:to-gray-800">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 sm:h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 gradient-bg rounded-xl flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3l3.057-3L11 2l3 1 3-1 3 2-1 5-2 6-3 4-1 2-1-2-3-4-2-6-1-5z" />
                        </svg>
                    </div>
                    <span class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white">HikingApp</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home"
                        class="text-gray-700 dark:text-gray-300 hover:text-emerald-500 transition">Beranda</a>
                    <a href="#features"
                        class="text-gray-700 dark:text-gray-300 hover:text-emerald-500 transition">Fitur</a>
                    <a href="#contact"
                        class="text-gray-700 dark:text-gray-300 hover:text-emerald-500 transition">Kontak</a>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        @auth
                            {{-- DASHBOARD (auto admin / user) --}}
                            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                                class="px-3 sm:px-6 py-2 text-sm sm:text-base gradient-bg text-white rounded-lg
                      hover:shadow-xl transform hover:scale-105 transition font-medium">
                                Dashboard
                            </a>
                        @else
                            {{-- LOGIN --}}
                            <a href="{{ route('login') }}"
                                class="hidden sm:block px-4 py-2 text-sm text-emerald-600
                      dark:text-emerald-400 hover:text-emerald-700
                      dark:hover:text-emerald-300 font-medium transition">
                                Masuk
                            </a>

                            {{-- REGISTER --}}
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-3 sm:px-6 py-2 text-sm sm:text-base gradient-bg text-white rounded-lg
                          hover:shadow-xl transform hover:scale-105 transition font-medium">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-24 sm:pt-32 pb-12 sm:pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Content -->
                <div class="fade-in text-center lg:text-left">
                    <div
                        class="inline-flex items-center space-x-2 bg-emerald-100 dark:bg-emerald-900/30 px-4 py-2 rounded-full mb-6">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-sm text-emerald-700 dark:text-emerald-300 font-medium">Bergabung dengan
                            10,000+ Pendaki</span>
                    </div>

                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        Jelajahi
                        <span class="gradient-text"> Puncak Tertinggi</span>
                        Indonesia
                    </h1>

                    <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-xl mx-auto lg:mx-0">
                        Pesan tiket hiking untuk gunung-gunung terbaik di Indonesia. Pengalaman mendaki yang aman,
                        mudah, dan tak terlupakan menanti Anda.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#destinations"
                            class="px-8 py-4 gradient-bg text-white rounded-xl hover:shadow-2xl transform hover:scale-105 transition font-semibold text-center">
                            Pesan Sekarang
                        </a>
                        <a href="#features"
                            class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl border-2 border-emerald-500 hover:bg-emerald-50 dark:hover:bg-gray-700 transition font-semibold text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <!-- Stats -->
                    <div
                        class="grid grid-cols-3 gap-4 sm:gap-8 mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold text-emerald-600 dark:text-emerald-400">50+</div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Destinasi</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold text-emerald-600 dark:text-emerald-400">10K+
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Pendaki</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold text-emerald-600 dark:text-emerald-400">4.9★
                            </div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Rating</div>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="relative floating hidden lg:block">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-3xl blur-3xl opacity-20">
                    </div>
                    <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=800&q=80"
                        alt="Hiking" class="relative rounded-3xl shadow-2xl w-full">

                    <!-- Floating Cards -->
                    <div class="absolute -bottom-6 -left-6 bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-800 dark:text-white">Pemesanan Mudah</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">100% Online</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Destinations -->
    <section id="destinations" class="py-12 sm:py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                    Destinasi <span class="gradient-text">Populer</span>
                </h2>
                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Temukan gunung-gunung terbaik di Indonesia untuk pengalaman hiking yang luar biasa
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div
                    class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl overflow-hidden hover-lift cursor-pointer">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=600&q=80"
                            alt="Gunung Rinjani" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 right-4 bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Populer
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Gunung Rinjani</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Lombok, NTB • 3,726 mdpl</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">Rp 350K</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">3 Hari 2 Malam</span>
                        </div>
                        <button
                            class="w-full py-3 gradient-bg text-white rounded-xl font-semibold hover:shadow-lg transition">
                            Pesan Tiket
                        </button>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl overflow-hidden hover-lift cursor-pointer">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=600&q=80"
                            alt="Gunung Semeru" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Trending
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Gunung Semeru</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Jawa Timur • 3,676 mdpl</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">Rp 300K</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">2 Hari 1 Malam</span>
                        </div>
                        <button
                            class="w-full py-3 gradient-bg text-white rounded-xl font-semibold hover:shadow-lg transition">
                            Pesan Tiket
                        </button>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl overflow-hidden hover-lift cursor-pointer">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80"
                            alt="Gunung Bromo" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Pemula
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Gunung Bromo</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Jawa Timur • 2,329 mdpl</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">Rp 150K</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">1 Hari</span>
                        </div>
                        <button
                            class="w-full py-3 gradient-bg text-white rounded-xl font-semibold hover:shadow-lg transition">
                            Pesan Tiket
                        </button>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl overflow-hidden hover-lift cursor-pointer">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80"
                            alt="Gunung Ijen" class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Eksotis
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Gunung Ijen</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Jawa Timur • 2,799 mdpl</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">Rp 200K</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">1 Hari</span>
                        </div>
                        <button
                            class="w-full py-3 gradient-bg text-white rounded-xl font-semibold hover:shadow-lg transition">
                            Pesan Tiket
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center px-8 py-4 bg-white dark:bg-gray-800 text-emerald-600 dark:text-emerald-400 rounded-xl border-2 border-emerald-500 hover:bg-emerald-50 dark:hover:bg-gray-700 transition font-semibold">
                    Lihat Semua Destinasi
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-12 sm:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                    Mengapa <span class="gradient-text">HikingApp?</span>
                </h2>
                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Platform pemesanan tiket hiking terlengkap dan terpercaya di Indonesia
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl hover:shadow-xl transition">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-600 dark:text-gray-300">Dapatkan harga terbaik dengan berbagai promo menarik
                        setiap bulannya</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl hover:shadow-xl transition">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Aman & Terpercaya</h3>
                    <p class="text-gray-600 dark:text-gray-300">Dengan guide profesional dan perlengkapan lengkap untuk
                        keamanan Anda</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl hover:shadow-xl transition">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Pemesanan Instan</h3>
                    <p class="text-gray-600 dark:text-gray-300">Booking online 24/7 dengan konfirmasi langsung ke email
                        Anda</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl hover:shadow-xl transition">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Komunitas Aktif</h3>
                    <p class="text-gray-600 dark:text-gray-300">Bergabung dengan ribuan pendaki dari seluruh Indonesia
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl hover:shadow-xl transition">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Support 24/7</h3>
                    <p class="text-gray-600 dark:text-gray-300">Tim customer service siap membantu kapan saja Anda
                        membutuhkan</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl hover:shadow-xl transition">
                    <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Rating Terbaik</h3>
                    <p class="text-gray-600 dark:text-gray-300">Dipercaya dengan rating 4.9/5 dari ribuan pendaki</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 sm:py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900">
        <div class="max-w-5xl mx-auto">
            <div class="gradient-bg rounded-3xl p-8 sm:p-12 lg:p-16 text-center relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full -ml-32 -mb-32"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">
                        Siap Memulai Petualangan?
                    </h2>
                    <p class="text-lg sm:text-xl text-emerald-50 mb-8 max-w-2xl mx-auto">
                        Daftar sekarang dan dapatkan diskon 20% untuk pemesanan pertama Anda!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#"
                            class="px-8 py-4 bg-white text-emerald-600 rounded-xl hover:bg-gray-100 transition font-semibold text-center">
                            Daftar Gratis
                        </a>
                        <a href="#"
                            class="px-8 py-4 bg-emerald-700 text-white rounded-xl hover:bg-emerald-800 transition font-semibold border-2 border-white/20 text-center">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-black text-gray-300 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3l3.057-3L11 2l3 1 3-1 3 2-1 5-2 6-3 4-1 2-1-2-3-4-2-6-1-5z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">HikingApp</span>
                    </div>
                    <p class="text-sm text-gray-400 mb-4">
                        Platform pemesanan tiket hiking terlengkap di Indonesia untuk petualangan Anda.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Tentang Kami</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Destinasi</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Promo</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Blog</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Karir</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Bantuan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">FAQ</a></li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Cara Pemesanan</a>
                        </li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Kebijakan Privasi</a>
                        </li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Syarat & Ketentuan</a>
                        </li>
                        <li><a href="#" class="text-sm hover:text-emerald-400 transition">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 mt-0.5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">Jl. Gunung Semeru No. 123<br>Jakarta, Indonesia</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm">info@hikingapp.id</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-sm">+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
