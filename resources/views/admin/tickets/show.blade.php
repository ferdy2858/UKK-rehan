<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🎟️ Detail Tiket
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Info Tiket -->
        <div class="bg-white shadow rounded-lg p-6 space-y-3">
            <p><strong>User:</strong> {{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
            <p><strong>Gunung:</strong> {{ $ticket->schedule->mountain->name }}</p>
            <p><strong>Tanggal:</strong> {{ $ticket->schedule->date->format('d M Y') }}</p>
            <p><strong>Jumlah Pendaki:</strong> {{ $ticket->total_people }}</p>
            <p>
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded text-xs
                    @if($ticket->status === 'approved') bg-green-100 text-green-700
                    @elseif($ticket->status === 'rejected') bg-red-100 text-red-700
                    @else bg-yellow-100 text-yellow-700
                    @endif">
                    {{ ucfirst($ticket->status) }}
                </span>
            </p>
        </div>

        <!-- Anggota -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-3">👥 Anggota Pendaki</h3>
            <ul class="list-disc ml-6 space-y-1">
                @foreach ($ticket->members as $member)
                    <li>
                        {{ $member->name }} —
                        {{ $member->nik }} —
                        {{ $member->phone }}
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Action -->
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

    </div>
</x-app-layout>
