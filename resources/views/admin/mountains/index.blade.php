<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold">🏔️ Data Gunung</h1>
            <a href="{{ route('admin.mountains.create') }}" class="px-4 py-2 bg-green-700 text-white rounded">
                + Tambah Gunung
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Lokasi</th>
                        <th class="border p-2">Tinggi (mdpl)</th>
                        <th class="border p-2">Kuota / Hari</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mountains as $mountain)
                        <tr>
                            <td class="border p-2">{{ $mountain->name }}</td>
                            <td class="border p-2">{{ $mountain->location }}</td>
                            <td class="border p-2">{{ $mountain->height }} Mdpl</td>
                            <td class="border p-2">{{ $mountain->quota_per_day }} Orang</td>
                            <td class="border p-2 flex gap-2">
                                <a href="{{ route('admin.mountains.edit', $mountain) }}" class="text-blue-600">Edit</a>

                                <form method="POST" action="{{ route('admin.mountains.destroy', $mountain) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600" onclick="return confirm('Yakin hapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
