<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🎟️ Tiket Saya
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('user.tickets.create') }}"
               class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                + Pesan Tiket
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="p-3 text-left">Gunung</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                        <tr class="border-b">
                            <td class="p-3">{{ $ticket->schedule->mountain->name }}</td>
                            <td class="p-3 text-center">{{ $ticket->schedule->date->format('d M Y') }}</td>
                            <td class="p-3 text-center">{{ $ticket->total_people }}</td>
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 rounded text-xs
                                    @if($ticket->status === 'approved') bg-green-100 text-green-700
                                    @elseif($ticket->status === 'rejected') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('user.tickets.show', $ticket) }}"
                                   class="text-green-700 hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Belum ada tiket.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
