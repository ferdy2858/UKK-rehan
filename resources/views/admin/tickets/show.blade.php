<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🎟️ Detail Tiket Pendakian
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- INFO TIKET -->
        <div class="bg-white shadow rounded-lg p-6 space-y-3">
            <p>
                <strong>User:</strong>
                {{ $ticket->user->name }}
                <span class="text-gray-500">({{ $ticket->user->email }})</span>
            </p>

            <p>
                <strong>Gunung:</strong>
                {{ $ticket->schedule->mountain->name }}
            </p>

            <p>
                <strong>Tanggal Mendaki:</strong>
                {{ \Carbon\Carbon::parse($ticket->hike_date)->format('d M Y') }}
            </p>

            <p>
                <strong>Jumlah Pendaki:</strong>
                {{ $ticket->total_people }} orang
            </p>

            <p>
                <strong>Total Harga:</strong>
                Rp {{ number_format($ticket->total_price) }}
            </p>

            <p>
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded text-xs
                    @if($ticket->status === 'approved') bg-green-100 text-green-700
                    @elseif($ticket->status === 'rejected') bg-red-100 text-red-700
                    @elseif($ticket->status === 'used') bg-gray-200 text-gray-700
                    @else bg-yellow-100 text-yellow-700
                    @endif">
                    {{ ucfirst($ticket->status) }}
                </span>
            </p>

            {{-- KODE VERIFIKASI --}}
            @if ($ticket->status === 'approved')
                <div class="mt-3 p-4 bg-green-50 rounded border">
                    <p class="font-semibold text-green-800">
                        🔐 Kode Verifikasi Pendakian
                    </p>
                    <p class="text-xl font-mono tracking-widest text-green-700">
                        {{ $ticket->verification_code }}
                    </p>
                </div>
            @endif

            {{-- SUDAH DIGUNAKAN --}}
            @if ($ticket->status === 'used')
                <div class="mt-3 p-4 bg-gray-100 rounded border text-gray-700">
                    ✅ Tiket sudah digunakan
                    <div class="text-sm">
                        Diverifikasi pada:
                        {{ $ticket->verified_at?->format('d M Y H:i') }}
                    </div>
                </div>
            @endif
        </div>

        <!-- ANGGOTA -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-3">👥 Anggota Pendaki</h3>

            <ul class="space-y-2">
                @foreach ($ticket->members as $member)
                    <li class="border rounded p-3">
                        <div class="font-medium">{{ $member->name }}</div>
                        <div class="text-sm text-gray-600">
                            NIK: {{ $member->nik }} |
                            HP: {{ $member->phone }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- ACTION ADMIN -->
        @if ($ticket->status === 'pending')
            <div class="flex gap-3">
                <form method="POST" action="{{ route('admin.tickets.approve', $ticket) }}">
                    @csrf
                    @method('PATCH')
                    <button
                        class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                        ✅ Approve
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.tickets.reject', $ticket) }}">
                    @csrf
                    @method('PATCH')
                    <button
                        class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
                        ❌ Reject
                    </button>
                </form>
            </div>
        @endif

        {{-- INFO HARI-H --}}
        @if ($ticket->status === 'approved' && $ticket->hike_date === now()->toDateString())
            <div class="p-4 bg-green-100 border rounded text-green-800">
                📍 Tiket ini <strong>SIAP DIVERIFIKASI</strong> hari ini
            </div>
        @endif

    </div>
</x-app-layout>
