<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            📄 Detail Tiket
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- INFO TIKET -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold text-lg mb-1">
                {{ $ticket->schedule->mountain->name }}
            </h3>

            <p class="text-sm text-gray-500 mb-3">
                Jadwal tersedia:
                {{ \Carbon\Carbon::parse($ticket->schedule->start_date)->format('d M') }}
                –
                {{ \Carbon\Carbon::parse($ticket->schedule->end_date)->format('d M Y') }}
            </p>

            <div class="space-y-1 text-sm">
                <p>
                    <span class="font-medium">Tanggal Mendaki:</span>
                    {{ \Carbon\Carbon::parse($ticket->hike_date)->format('d M Y') }}
                </p>

                <p>
                    <span class="font-medium">Tanggal Turun:</span>
                    @if ($ticket->returned_at)
                        {{ \Carbon\Carbon::parse($ticket->returned_at)->format('d M Y') }}
                    @else
                        <span class="italic text-gray-500">
                            Belum tercatat
                        </span>
                    @endif
                </p>

                <p>
                    <span class="font-medium">Jumlah Pendaki:</span>
                    {{ $ticket->total_people }} orang
                </p>

                <p>
                    <span class="font-medium">Harga / Orang:</span>
                    Rp {{ number_format($ticket->schedule->price) }}
                </p>

                <p class="font-semibold text-green-700">
                    Total Bayar:
                    Rp {{ number_format($ticket->total_price) }}
                </p>
            </div>

            <!-- STATUS -->
            <div class="mt-3">
                <span
                    class="inline-block px-3 py-1 rounded text-sm font-medium
                    @if ($ticket->status === 'approved') bg-green-100 text-green-700
                    @elseif($ticket->status === 'used' && !$ticket->returned_at)
                        bg-blue-100 text-blue-700
                    @elseif($ticket->returned_at)
                        bg-green-200 text-green-800
                    @elseif($ticket->status === 'rejected')
                        bg-red-100 text-red-700
                    @else
                        bg-yellow-100 text-yellow-700 @endif">
                    Status: {{ ucfirst($ticket->status) }}
                </span>
            </div>

            <!-- KODE VERIFIKASI -->
            @if ($ticket->status === 'approved')
                <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded">
                    <p class="font-semibold text-green-800">
                        🔐 Kode Verifikasi Pendakian
                    </p>
                    <p class="text-xl font-mono tracking-widest text-green-900 mt-1">
                        {{ $ticket->verification_code }}
                    </p>
                    <p class="text-xs text-green-700 mt-1">
                        Tunjukkan kode ini saat check-in di basecamp
                    </p>
                </div>
            @endif

            <!-- SUDAH DIGUNAKAN -->
            @if ($ticket->status === 'used' && !$ticket->returned_at)
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded">
                    <p class="font-semibold text-blue-800">
                        ⛰️ Pendakian sedang berlangsung
                    </p>
                    <p class="text-sm text-blue-700">
                        Silakan lakukan konfirmasi turun setelah selesai
                    </p>
                </div>
            @endif

            <!-- SUDAH TURUN -->
            @if ($ticket->returned_at)
                <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded">
                    <p class="font-semibold text-green-800">
                        ✅ Pendaki telah tercatat turun dengan aman
                    </p>
                    <p class="text-sm text-green-700">
                        Terima kasih telah menjaga keselamatan
                    </p>
                </div>
            @endif

            <!-- MENUNGGU -->
            @if ($ticket->status === 'pending')
                <p class="mt-4 text-sm text-yellow-600">
                    ⏳ Menunggu verifikasi admin
                </p>
            @endif
        </div>

        <!-- DATA PENDAKI -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-3">👥 Data Pendaki</h3>

            <ul class="space-y-3">
                @foreach ($ticket->members as $member)
                    <li class="border rounded p-3">
                        <div class="font-medium">
                            {{ $loop->iteration }}. {{ $member->name }}
                        </div>
                        <div class="text-sm text-gray-600">
                            NIK: {{ $member->nik }} <br>
                            HP: {{ $member->phone }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <a href="{{ route('user.tickets.index') }}" class="text-sm text-gray-600 hover:underline">
                ← Kembali ke tiket saya
            </a>
        </div>

    </div>
</x-app-layout>
