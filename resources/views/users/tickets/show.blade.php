<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user.tickets.index') }}"
                class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow hover:shadow-md transition-shadow">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Detail Tiket Pendakian
                </h2>
                <p class="text-sm text-gray-500">Informasi lengkap tiket Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- ================= HERO TICKET CARD ================= --}}
        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            @if ($ticket->status === 'approved' || $ticket->status === 'used')
                <div class="relative bg-gradient-to-br from-emerald-500 via-green-600 to-teal-700 p-8">
                @elseif($ticket->status === 'pending')
                    <div class="relative bg-gradient-to-br from-amber-500 via-orange-600 to-yellow-700 p-8">
                    @elseif($ticket->status === 'rejected')
                        <div class="relative bg-gradient-to-br from-red-500 via-rose-600 to-pink-700 p-8">
                        @else
                            <div class="relative bg-gradient-to-br from-gray-500 via-gray-600 to-gray-700 p-8">
            @endif
            <!-- Decorative Background -->
            <div class="absolute inset-0 opacity-10">
                <svg class="absolute bottom-0 right-0 w-96 h-96" viewBox="0 0 200 200" fill="white">
                    <path d="M0,100 L50,80 L100,100 L150,70 L200,90 L200,200 L0,200 Z"></path>
                </svg>
                <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -ml-32 -mt-32"></div>
            </div>

            <div class="relative">
                <!-- Ticket Header -->
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                            <span class="text-4xl">🎫</span>
                        </div>
                        <div>
                            <div class="text-white/80 text-sm font-medium">Tiket Pendakian</div>
                            <div class="text-white text-sm font-mono">#{{ str_pad($ticket->id, 6, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    @if ($ticket->status === 'approved')
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-400 text-white rounded-full font-bold shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Approved
                        </span>
                    @elseif($ticket->status === 'used' && !$ticket->returned_at)
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-400 text-white rounded-full font-bold shadow-lg animate-pulse">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            Di Gunung
                        </span>
                    @elseif($ticket->returned_at)
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-green-700 rounded-full font-bold shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Selesai
                        </span>
                    @elseif($ticket->status === 'rejected')
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-red-700 rounded-full font-bold shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Ditolak
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white text-amber-700 rounded-full font-bold shadow-lg">
                            <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                            Pending
                        </span>
                    @endif
                </div>

                <!-- Mountain Name -->
                <h3 class="text-4xl font-bold text-white mb-2">
                    {{ $ticket->schedule->mountain->name }}
                </h3>

                <div class="text-white/80 text-sm">
                    Periode: {{ \Carbon\Carbon::parse($ticket->schedule->start_date)->format('d M') }} –
                    {{ \Carbon\Carbon::parse($ticket->schedule->end_date)->format('d M Y') }}
                </div>

                <!-- Info Grid -->
                <div class="grid md:grid-cols-2 gap-4 mt-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📅</span>
                        </div>
                        <div>
                            <div class="text-white/70 text-xs">Tanggal Mendaki</div>
                            <div class="text-white font-bold">
                                {{ \Carbon\Carbon::parse($ticket->hike_date)->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">🏁</span>
                        </div>
                        <div>
                            <div class="text-white/70 text-xs">Tanggal Turun</div>
                            @if ($ticket->returned_at)
                                <div class="text-white font-bold">
                                    {{ \Carbon\Carbon::parse($ticket->returned_at)->format('d M Y') }}</div>
                            @else
                                <div class="text-white/60 italic text-sm">Belum tercatat</div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">👥</span>
                        </div>
                        <div>
                            <div class="text-white/70 text-xs">Jumlah Pendaki</div>
                            <div class="text-white font-bold">{{ $ticket->total_people }} Orang</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <span class="text-2xl">💰</span>
                        </div>
                        <div>
                            <div class="text-white/70 text-xs">Total Pembayaran</div>
                            <div class="text-white font-bold">Rp {{ number_format($ticket->total_price) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Price Breakdown -->
                <div class="mt-6 p-4 bg-white/10 backdrop-blur-md rounded-xl border border-white/20">
                    <div class="flex items-center justify-between text-white text-sm">
                        <span>Harga per Orang</span>
                        <span class="font-semibold">Rp {{ number_format($ticket->schedule->price) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-white text-sm mt-2">
                        <span>Jumlah Pendaki</span>
                        <span class="font-semibold">× {{ $ticket->total_people }}</span>
                    </div>
                    <div class="border-t border-white/20 mt-3 pt-3 flex items-center justify-between text-white">
                        <span class="font-bold">Total Bayar</span>
                        <span class="text-2xl font-bold">Rp {{ number_format($ticket->total_price) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= VERIFICATION CODE / STATUS INFO ================= --}}
    @if ($ticket->status === 'approved')
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-400 to-green-600 rounded-2xl shadow-lg p-6">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>
            <div class="relative">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <span class="text-3xl">🔐</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-white mb-2">Kode Verifikasi Pendakian</h4>
                        <div class="bg-white rounded-xl p-4 mb-3">
                            <div class="text-center">
                                <div class="text-5xl font-mono font-bold text-emerald-700 tracking-widest">
                                    {{ $ticket->verification_code }}
                                </div>
                            </div>
                        </div>
                        <p class="text-white/90 text-sm">
                            ✨ Tunjukkan kode ini saat check-in di basecamp
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($ticket->status === 'used' && !$ticket->returned_at)
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-400 to-indigo-600 rounded-2xl shadow-lg p-6">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>
            <div class="relative flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center animate-pulse">
                        <span class="text-3xl">⛰️</span>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-white mb-1">Pendakian Sedang Berlangsung</h4>
                    <p class="text-white/90 text-sm">
                        Tetap jaga keselamatan dan lakukan konfirmasi turun setelah selesai mendaki
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if ($ticket->returned_at)
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-400 to-teal-600 rounded-2xl shadow-lg p-6">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>
            <div class="relative flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                        <span class="text-3xl">✅</span>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-white mb-1">Pendakian Selesai</h4>
                    <p class="text-white/90 text-sm">
                        Pendaki telah tercatat turun dengan aman. Terima kasih telah menjaga keselamatan! 🎉
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if ($ticket->status === 'pending')
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl shadow-lg p-6">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>
            <div class="relative flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                        <span class="text-3xl">⏳</span>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-white mb-1">Menunggu Verifikasi</h4>
                    <p class="text-white/90 text-sm">
                        Tiket Anda sedang dalam proses verifikasi oleh admin. Mohon tunggu sebentar
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if ($ticket->status === 'rejected')
        <div class="relative overflow-hidden bg-gradient-to-br from-red-400 to-pink-600 rounded-2xl shadow-lg p-6">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>
            <div class="relative flex items-center gap-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                        <span class="text-3xl">❌</span>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-white mb-1">Tiket Ditolak</h4>
                    <p class="text-white/90 text-sm">
                        Mohon maaf, tiket Anda tidak dapat diproses. Silakan hubungi admin untuk informasi lebih lanjut
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- ================= HIKERS DATA ================= --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-purple-500 to-pink-600 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                    <span class="text-2xl">👥</span>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-white">Data Pendaki</h3>
                    <p class="text-purple-100 text-xs">{{ $ticket->total_people }} pendaki terdaftar</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($ticket->members as $member)
                    <div
                        class="group relative overflow-hidden border-2 border-gray-100 rounded-xl p-5 hover:border-purple-200 hover:shadow-md transition-all duration-200">
                        <div
                            class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full -mr-10 -mt-10 group-hover:scale-110 transition-transform">
                        </div>

                        <div class="relative flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                    {{ $loop->iteration }}
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-900 text-lg mb-3">
                                    {{ $member->name }}
                                </h4>

                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 text-sm">
                                        <div
                                            class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">NIK</div>
                                            <div class="font-mono text-gray-900">{{ $member->nik }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 text-sm">
                                        <div
                                            class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Nomor HP</div>
                                            <div class="font-medium text-gray-900">{{ $member->phone }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ================= BACK BUTTON ================= --}}
    <div class="flex justify-center">
        <a href="{{ route('user.tickets.index') }}"
            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-xl font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-200 shadow hover:shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Tiket
        </a>
    </div>

    </div>
</x-app-layout>
