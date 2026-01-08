<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">📅 Jadwal Pendakian</h1>

            <a href="{{ route('admin.hiking-schedules.create') }}"
               class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                + Tambah Jadwal
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-700 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="border p-2">Gunung</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Kuota</th>
                        <th class="border p-2">Sisa</th>
                        <th class="border p-2">Harga</th>                      
                        <th class="border p-2">Status</th>                      
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($schedules as $schedule)
                        <tr>
                            <td class="border p-2">
                                {{ $schedule->mountain->name }}
                            </td>
                            <td class="border p-2">
                                {{ $schedule->date->format('d M Y') }}
                            </td>
                            <td class="border p-2 text-center">
                                {{ $schedule->quota }}
                            </td>                           
                            <td class="border p-2 text-center">
                                {{ $schedule->remaining_quota ?? '-' }}
                            </td>
                            <td class="border p-2 text-center">
                                Rp :{{ $schedule->price }}
                            </td>
                            <td class="border p-2 text-center">
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $schedule->status === 'open'
                                        ? 'bg-green-200 text-green-800'
                                        : 'bg-red-200 text-red-800' }}">
                                    {{ strtoupper($schedule->status) }}
                                </span>
                            </td>
                            <td class="border p-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.hiking-schedules.edit', $schedule) }}"
                                       class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.hiking-schedules.destroy', $schedule) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Hapus jadwal ini?')"
                                            class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">
                                Belum ada jadwal pendakian
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
