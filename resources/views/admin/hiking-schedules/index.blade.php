<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            <h1 class="text-2xl font-bold text-green-800 flex items-center gap-2">
                📅 Jadwal Pendakian
            </h1>

            <a href="{{ route('admin.hiking-schedules.create') }}"
                class="inline-flex items-center gap-2 bg-green-700 text-white px-5 py-2 rounded-lg hover:bg-green-800 transition font-semibold">
                ➕ Tambah Jadwal
            </a>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-green-700 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Gunung</th>
                            <th class="px-4 py-3 text-left">Periode</th>
                            <th class="px-4 py-3 text-center">Kuota / Hari</th>
                            <th class="px-4 py-3 text-center">Harga</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($schedules as $schedule)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Gunung -->
                                <td class="px-4 py-3 font-medium">
                                    {{ $schedule->mountain->name }}
                                </td>

                                <!-- Periode -->
                                <td class="px-4 py-3">
                                    {{ $schedule->start_date->format('d M Y') }}
                                    –
                                    {{ $schedule->end_date->format('d M Y') }}
                                </td>

                                <!-- Kuota -->
                                <td class="px-4 py-3 text-center">
                                    {{ $schedule->quota }}
                                </td>

                                <!-- Harga -->
                                <td class="px-4 py-3 text-center">
                                    Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $schedule->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ strtoupper($schedule->status) }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.hiking-schedules.edit', $schedule) }}"
                                            class="text-blue-600 hover:underline font-medium">
                                            Edit
                                        </a>

                                        <form method="POST"
                                            action="{{ route('admin.hiking-schedules.destroy', $schedule) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus jadwal ini?')"
                                                class="text-red-600 hover:underline font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    Belum ada jadwal pendakian
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
