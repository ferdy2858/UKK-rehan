<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-2xl">🧭</span>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800">
                        Dashboard Pendaki
                    </h2>
                    <p class="text-sm text-gray-500">Selamat datang, {{ auth()->user()->name }}! 👋</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- ================= HERO ACTIVE TICKET ================= --}}
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            @if ($activeTicket)
                <!-- Active Ticket Card -->
                <div class="relative bg-gradient-to-br from-emerald-500 via-green-600 to-teal-700 p-8">
                    <!-- Decorative Background -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="absolute bottom-0 right-0 w-64 h-64" viewBox="0 0 200 200" fill="white">
                            <path d="M0,100 L50,80 L100,100 L150,70 L200,90 L200,200 L0,200 Z"></path>
                        </svg>
                        <svg class="absolute top-0 left-0 w-48 h-48" viewBox="0 0 200 200" fill="white">
                            <circle cx="0" cy="0" r="100"></circle>
                        </svg>
                    </div>

                    <div class="relative">
                        <!-- Badge -->
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md rounded-full border border-white/30 mb-4">
                            <span class="text-lg">🎫</span>
                            <span class="text-white font-bold text-sm">TIKET AKTIF</span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 items-center">
                            <div>
                                <!-- Mountain Name -->
                                <h3 class="text-4xl font-bold text-white mb-2">
                                    {{ $activeTicket->schedule->mountain->name }}
                                </h3>

                                <!-- Info Grid -->
                                <div class="space-y-3 text-white/90 mt-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                            <span class="text-xl">📅</span>
                                        </div>
                                        <div>
                                            <div class="text-xs text-white/70">Tanggal Naik</div>
                                            <div class="font-semibold">{{ $activeTicket->hike_date->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                            <span class="text-xl">🎟️</span>
                                        </div>
                                        <div>
                                            <div class="text-xs text-white/70">ID Tiket</div>
                                            <div class="font-semibold font-mono">
                                                #{{ str_pad($activeTicket->id, 6, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="mt-6">
                                    @if ($activeTicket->status === 'approved')
                                        <span
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-400 text-white rounded-full font-bold shadow-lg">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Approved
                                        </span>
                                    @elseif($activeTicket->status === 'used')
                                        <span
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-400 text-white rounded-full font-bold shadow-lg animate-pulse">
                                            <span class="w-2 h-2 bg-white rounded-full"></span>
                                            Di Gunung
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-amber-400 text-white rounded-full font-bold shadow-lg">
                                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                            {{ ucfirst($activeTicket->status) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Action Button -->
                                <div class="mt-6">
                                    <a href="{{ route('user.tickets.show', $activeTicket) }}"
                                        class="inline-flex items-center gap-2 bg-white text-emerald-700 px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Lihat Detail Tiket
                                    </a>
                                </div>
                            </div>

                            <!-- Illustration -->
                            <div class="hidden md:flex items-center justify-center">
                                <div class="relative">
                                    <div
                                        class="w-48 h-48 bg-white/10 backdrop-blur-sm rounded-3xl flex items-center justify-center transform rotate-6 hover:rotate-12 transition-transform duration-300">
                                        <span class="text-8xl">🏔️</span>
                                    </div>
                                    <div
                                        class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                        <span class="text-4xl">✅</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Active Ticket -->
                <div class="relative bg-gradient-to-br from-gray-500 via-gray-600 to-gray-700 p-8">
                    <div class="absolute inset-0 opacity-10">
                        <svg class="absolute bottom-0 right-0 w-64 h-64" viewBox="0 0 200 200" fill="white">
                            <path d="M0,100 L50,80 L100,100 L150,70 L200,90 L200,200 L0,200 Z"></path>
                        </svg>
                    </div>

                    <div class="relative text-center py-8">
                        <div
                            class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-md rounded-full mb-6">
                            <span class="text-5xl">🎫</span>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Tiket Aktif</h3>
                        <p class="text-white/80 mb-6">Mulai petualanganmu dengan memesan tiket pendakian</p>

                        <a href="{{ route('user.tickets.create') }}"
                            class="inline-flex items-center gap-2 bg-white text-gray-700 px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Pesan Tiket Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>

        {{-- ================= STATISTICS CARDS ================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Total Tickets -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-purple-500 to-indigo-600 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">🎟️</span>
                        </div>
                        <svg class="w-8 h-8 text-white/20" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-white/80 text-sm font-medium mb-1">Total Tiket</div>
                    <div class="text-4xl font-bold text-white">{{ $totalTickets }}</div>
                    <div class="mt-2 text-white/60 text-xs">Sepanjang waktu</div>
                </div>
            </div>

            <!-- Mountains Climbed -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 to-teal-600 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-3">
                        <div
                            class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">⛰️</span>
                        </div>
                        <svg class="w-8 h-8 text-white/20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-white/80 text-sm font-medium mb-1">Gunung Didaki</div>
                    <div class="text-4xl font-bold text-white">{{ $mountainCount }}</div>
                    <div class="mt-2 text-white/60 text-xs">Destinasi unik</div>
                </div>
            </div>

            <!-- Last Status -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-600 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-3">
                        <div
                            class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📊</span>
                        </div>
                        <svg class="w-8 h-8 text-white/20" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-white/80 text-sm font-medium mb-1">Status Terakhir</div>
                    <div class="text-2xl font-bold text-white capitalize">{{ $lastStatus }}</div>
                    <div class="mt-2 text-white/60 text-xs">Aktivitas terkini</div>
                </div>
            </div>
        </div>

        {{-- ================= TICKET HISTORY ================= --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                            <span class="text-2xl">🧾</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-white">Riwayat Tiket</h3>
                            <p class="text-blue-100 text-xs">Aktivitas pendakian Anda</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse ($latestTickets as $ticket)
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors group">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <!-- Icon -->
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="text-2xl">🏔️</span>
                                </div>

                                <!-- Info -->
                                <div>
                                    <div class="font-bold text-gray-900 text-lg">
                                        {{ $ticket->schedule->mountain->name }}
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span
                                            class="text-sm text-gray-600">{{ $ticket->hike_date->format('d M Y') }}</span>
                                    </div>
                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ $ticket->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div>
                                @if ($ticket->status === 'approved')
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-bold">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Approved
                                    </span>
                                @elseif($ticket->status === 'used')
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-bold">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                                        Di Gunung
                                    </span>
                                @elseif($ticket->status === 'completed')
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm font-bold">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Selesai
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-bold">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                            <span class="text-4xl">📋</span>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada riwayat tiket</p>
                        <p class="text-gray-400 text-sm mt-1">Pesan tiket pertamamu sekarang!</p>
                        <a href="{{ route('user.tickets.create') }}"
                            class="inline-flex items-center gap-2 mt-4 px-6 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg font-semibold hover:from-blue-600 hover:to-indigo-700 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Pesan Tiket
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ================= HIKING TIPS ================= --}}
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Tips Card -->
            <div
                class="relative overflow-hidden bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl shadow-lg p-6">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">🧠</span>
                        </div>
                        <h3 class="font-bold text-xl text-white">Tips Pendakian</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-white">
                            <div
                                class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Pastikan logistik dan perlengkapan cukup</span>
                        </li>
                        <li class="flex items-start gap-3 text-white">
                            <div
                                class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Laporkan saat turun kepada petugas</span>
                        </li>
                        <li class="flex items-start gap-3 text-white">
                            <div
                                class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Jaga kebersihan dan kelestarian alam</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Safety Card -->
            <div class="relative overflow-hidden bg-gradient-to-br from-red-400 to-pink-500 rounded-2xl shadow-lg p-6">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">🚨</span>
                        </div>
                        <h3 class="font-bold text-xl text-white">Keselamatan Prioritas</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-white">
                            <div
                                class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-sm">🏥</span>
                            </div>
                            <span class="font-medium">Bawa P3K dan obat-obatan pribadi</span>
                        </li>
                        <li class="flex items-start gap-3 text-white">
                            <div
                                class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-sm">📱</span>
                            </div>
                            <span class="font-medium">Informasikan rencana ke keluarga</span>
                        </li>
                        <li class="flex items-start gap-3 text-white">
                            <div
                                class="w-6 h-6 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-sm">⚡</span>
                            </div>
                            <span class="font-medium">Pantau kondisi cuaca sebelum naik</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
