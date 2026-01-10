<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🎟️ Manajemen Tiket Pendakian
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="p-3 text-left">User</th>
                        <th class="p-3 text-left">Gunung</th>
                        <th class="p-3">Tanggal Mendaki</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                        <tr class="border-b">

                            <!-- USER -->
                            <td class="p-3">
                                {{ $ticket->user->name }}
                                <div class="text-xs text-gray-500">
                                    {{ $ticket->user->email }}
                                </div>
                            </td>

                            <!-- GUNUNG -->
                            <td class="p-3">
                                {{ $ticket->schedule->mountain->name }}
                            </td>

                            <!-- TANGGAL MENDAKI (HARI-H) -->
                            <td class="p-3 text-center">
                                {{ \Carbon\Carbon::parse($ticket->hike_date)->format('d M Y') }}
                            </td>

                            <!-- JUMLAH -->
                            <td class="p-3 text-center">
                                {{ $ticket->total_people }}
                            </td>

                            <!-- STATUS -->
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 rounded text-xs
                                    @if($ticket->status === 'approved') bg-green-100 text-green-700
                                    @elseif($ticket->status === 'rejected') bg-red-100 text-red-700
                                    @elseif($ticket->status === 'used') bg-gray-200 text-gray-700
                                    @else bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="p-3 text-center space-x-2">
                                <a href="{{ route('admin.tickets.show', $ticket) }}"
                                   class="text-green-700 hover:underline">
                                    Detail
                                </a>

                                @if ($ticket->status === 'approved' && $ticket->hike_date === now()->toDateString())
                                    <span class="text-xs text-green-600 font-semibold">
                                        Siap diverifikasi
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                Belum ada tiket.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
