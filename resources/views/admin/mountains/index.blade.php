<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            <h1 class="text-2xl font-bold text-green-800 flex items-center gap-2">
                🏔️ Data Gunung
            </h1>

            <a href="{{ route('admin.mountains.create') }}"
                class="inline-flex items-center gap-2 bg-green-700 text-white px-5 py-2 rounded-lg hover:bg-green-800 transition font-semibold">
                ➕ Tambah Gunung
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-green-700 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Lokasi</th>
                            <th class="px-4 py-3 text-center">Tinggi</th>
                            <th class="px-4 py-3 text-center">Kuota / Hari</th>
                            <th class="px-4 py-3 text-center">Gambar</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($mountains as $mountain)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Nama -->
                                <td class="px-4 py-3 font-medium">
                                    {{ $mountain->name }}
                                </td>

                                <!-- Lokasi -->
                                <td class="px-4 py-3">
                                    {{ $mountain->location }}
                                </td>

                                <!-- Tinggi -->
                                <td class="px-4 py-3 text-center">
                                    {{ number_format($mountain->height) }} mdpl
                                </td>

                                <!-- Kuota -->
                                <td class="px-4 py-3 text-center">
                                    {{ $mountain->quota_per_day }} orang
                                </td>

                                <!-- Image -->
                                <td class="px-4 py-3 text-center">
                                    @if ($mountain->image)
                                        <img src="{{ asset('storage/' . $mountain->image) }}"
                                            class="w-24 h-16 object-cover rounded-lg shadow mx-auto">
                                    @else
                                        <span class="text-xs text-gray-400 italic">
                                            No Image
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-4 py-3">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.mountains.edit', $mountain) }}"
                                            class="text-blue-600 hover:underline font-medium">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.mountains.destroy', $mountain) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin hapus gunung ini?')"
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
                                    Belum ada data gunung
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
