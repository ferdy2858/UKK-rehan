<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-2xl">🏔️</span>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800">
                        Admin Dashboard
                    </h2>
                    <p class="text-sm text-gray-500">Kelola sistem pendakian dengan mudah</p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-emerald-50 rounded-lg border border-emerald-200">
                <span class="text-emerald-600 font-medium text-sm">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- ================= KPI CARDS ================= --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

            <!-- Total Tiket -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-700 p-5 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-3xl">📊</span>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-white/80 text-sm font-medium mb-1">Total Tiket</div>
                    <div class="text-3xl font-bold text-white">{{ $stats['total_tickets'] }}</div>
                </div>
            </div>

            <!-- Pending -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-amber-400 to-orange-500 p-5 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-3xl">⏳</span>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <span class="text-white text-xs font-bold">!</span>
                        </div>
                    </div>
                    <div class="text-white/90 text-sm font-medium mb-1">Pending</div>
                    <div class="text-3xl font-bold text-white">{{ $stats['pending'] }}</div>
                </div>
            </div>

            <!-- Approved -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-emerald-400 to-green-600 p-5 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-3xl">✅</span>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-white/90 text-sm font-medium mb-1">Approved</div>
                    <div class="text-3xl font-bold text-white">{{ $stats['approved'] }}</div>
                </div>
            </div>

            <!-- Di Gunung -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-blue-400 to-indigo-600 p-5 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-3xl">⛰️</span>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center animate-pulse">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                        </div>
                    </div>
                    <div class="text-white/90 text-sm font-medium mb-1">Di Gunung</div>
                    <div class="text-3xl font-bold text-white">{{ $stats['in_mountain'] }}</div>
                </div>
            </div>

            <!-- Selesai -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-gray-400 to-gray-600 p-5 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-3xl">🏁</span>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-white/90 text-sm font-medium mb-1">Selesai</div>
                    <div class="text-3xl font-bold text-white">{{ $stats['completed'] }}</div>
                </div>
            </div>

            <!-- Pendapatan -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-teal-400 to-emerald-600 p-5 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white opacity-10 rounded-full -mr-10 -mt-10"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-3xl">💰</span>
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                            <span class="text-white text-lg font-bold">₹</span>
                        </div>
                    </div>
                    <div class="text-white/90 text-xs font-medium mb-1">Pendapatan Bulan Ini</div>
                    <div class="text-xl font-bold text-white">Rp {{ number_format($stats['monthly_income']) }}</div>
                    <div class="text-xs text-white/70 mt-1">{{ now()->translatedFormat('F Y') }}</div>
                </div>
            </div>

        </div>

        {{-- ================= OVERDUE ALERT ================= --}}
        @if ($overdueHikers->count())
            <div class="relative overflow-hidden bg-gradient-to-r from-red-500 to-pink-600 rounded-2xl shadow-2xl">
                <div class="absolute inset-0 bg-grid-white/10"></div>
                <div class="relative p-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center animate-pulse">
                                <span class="text-3xl">🚨</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-4">
                                <h3 class="font-bold text-xl text-white">Peringatan Overdue!</h3>
                                <span
                                    class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-white text-xs font-bold">
                                    {{ $overdueHikers->count() }} Pendaki
                                </span>
                            </div>

                            <div class="bg-white/10 backdrop-blur-md rounded-xl overflow-hidden border border-white/20">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm">
                                        <thead class="bg-white/10">
                                            <tr class="text-white">
                                                <th class="px-4 py-3 text-left font-semibold">Nama Pendaki</th>
                                                <th class="px-4 py-3 text-left font-semibold">Gunung</th>
                                                <th class="px-4 py-3 text-left font-semibold">Tanggal Naik</th>
                                                <th class="px-4 py-3 text-left font-semibold">Batas Turun</th>
                                                <th class="px-4 py-3 text-center font-semibold">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-white/10">
                                            @foreach ($overdueHikers as $ticket)
                                                <tr class="text-white hover:bg-white/5 transition-colors">
                                                    <td class="px-4 py-3 font-medium">
                                                        <div class="flex items-center gap-2">
                                                            <div
                                                                class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-xs">
                                                                {{ substr($ticket->user->name, 0, 1) }}
                                                            </div>
                                                            {{ $ticket->user->name }}
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <span class="inline-flex items-center gap-1">
                                                            🏔️ {{ $ticket->schedule->mountain->name }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3">{{ $ticket->hike_date->format('d M Y') }}
                                                    </td>
                                                    <td class="px-4 py-3 font-semibold">
                                                        {{ $ticket->schedule->end_date->format('d M Y') }}</td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span
                                                            class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-400 text-yellow-900 rounded-full text-xs font-bold">
                                                            ⚠️ {{ $ticket->verified_at->diffInDays(now()) }} hari
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ================= ACTIVE HIKERS ================= --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                        <span class="text-2xl">🧭</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-white">Pendaki Aktif di Gunung</h3>
                        <p class="text-blue-100 text-xs">Monitoring pendaki yang sedang mendaki</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                @if ($activeHikers->isEmpty())
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                            <span class="text-4xl">🏕️</span>
                        </div>
                        <p class="text-gray-500 font-medium">Tidak ada pendaki di gunung saat ini</p>
                        <p class="text-gray-400 text-sm mt-1">Semua pendaki sudah kembali dengan selamat</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-200">
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Pendaki</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Gunung</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Naik</th>
                                    <th
                                        class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Progress</th>
                                    <th
                                        class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($activeHikers as $ticket)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold">
                                                    {{ substr($ticket->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $ticket->user->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">ID: #{{ $ticket->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-2">
                                                <span class="text-lg">⛰️</span>
                                                <span
                                                    class="font-medium text-gray-900">{{ $ticket->schedule->mountain->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $ticket->verified_at->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-500">
                                                {{ $ticket->verified_at->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                                                📍 Hari ke-{{ $ticket->day_number }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <form method="POST"
                                                action="{{ route('admin.tickets.markReturned', $ticket) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg font-medium hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Tandai Turun
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- ================= LATEST TICKETS ================= --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-purple-500 to-pink-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                            <span class="text-2xl">📄</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-white">Tiket Terbaru</h3>
                            <p class="text-purple-100 text-xs">Aktivitas pemesanan terkini</p>
                        </div>
                    </div>
                    <div class="hidden sm:block">
                        <span
                            class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-white text-xs font-semibold">
                            {{ $latestTickets->count() }} Tiket
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    User</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Gunung</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($latestTickets as $ticket)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                {{ substr($ticket->user->name, 0, 1) }}
                                            </div>
                                            <div class="font-medium text-gray-900">{{ $ticket->user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <span>🏔️</span>
                                            <span class="text-gray-900">{{ $ticket->schedule->mountain->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if ($ticket->status === 'pending')
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold">
                                                <span
                                                    class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                Pending
                                            </span>
                                        @elseif($ticket->status === 'approved')
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Approved
                                            </span>
                                        @elseif($ticket->status === 'used')
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">
                                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                                Di Gunung
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-xs font-bold">
                                                {{ ucfirst($ticket->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900">{{ $ticket->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <style>
        .bg-grid-white\/10 {
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</x-app-layout>
