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
                        <th class="p-3 text-center">Tanggal Mendaki</th>
                        <th class="p-3 text-center">Jumlah</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($tickets as $ticket)
                        <tr class="border-b hover:bg-gray-50">
                            <!-- GUNUNG -->
                            <td class="p-3">
                                <div class="font-medium">
                                    {{ $ticket->schedule->mountain->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    Jadwal:
                                    {{ \Carbon\Carbon::parse($ticket->schedule->start_date)->format('d M') }}
                                    -
                                    {{ \Carbon\Carbon::parse($ticket->schedule->end_date)->format('d M Y') }}
                                </div>
                            </td>

                            <!-- TANGGAL MENDAKI -->
                            <td class="p-3 text-center">
                                {{ \Carbon\Carbon::parse($ticket->hike_date)->format('d M Y') }}
                            </td>

                            <!-- JUMLAH -->
                            <td class="p-3 text-center">
                                {{ $ticket->total_people }} orang
                            </td>

                            <!-- STATUS -->
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    @if($ticket->status === 'approved')
                                        bg-green-100 text-green-700
                                    @elseif($ticket->status === 'rejected')
                                        bg-red-100 text-red-700
                                    @elseif($ticket->status === 'used')
                                        bg-blue-100 text-blue-700
                                    @else
                                        bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="p-3 text-center">
                                <a href="{{ route('user.tickets.show', $ticket) }}"
                                   class="text-green-700 hover:underline font-medium">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Belum ada tiket pendakian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
