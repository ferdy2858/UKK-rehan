<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🎟️ Detail Tiket
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <p><strong>Gunung:</strong> {{ $ticket->schedule->mountain->name }}</p>
            <p><strong>Tanggal:</strong> {{ $ticket->schedule->date->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>

            <hr>

            <h3 class="font-semibold">👥 Anggota Pendaki</h3>
            <ul class="list-disc ml-6">
                @foreach ($ticket->members as $member)
                    <li>{{ $member->name }} – {{ $member->phone }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
