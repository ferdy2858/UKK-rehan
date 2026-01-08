<x-app-layout>
    <div class="p-6 max-w-xl">
        <h1 class="text-xl font-bold mb-4">➕ Tambah Jadwal Pendakian</h1>

        <form method="POST" action="{{ route('admin.hiking-schedules.store') }}">
            @csrf

            <!-- Gunung -->
            <div class="mb-3">
                <label class="block font-medium mb-1">Gunung</label>
                <select name="mountain_id" class="w-full rounded border">
                    @foreach ($mountains as $mountain)
                        <option value="{{ $mountain->id }}">
                            {{ $mountain->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal -->
            <div class="mb-3">
                <label class="block font-medium mb-1">Tanggal</label>
                <input type="date" name="date" class="w-full rounded border">
            </div>

            <!-- Kuota -->
            <div class="mb-3">
                <label class="block font-medium mb-1">Kuota</label>
                <input type="number" name="quota" class="w-full rounded border">
            </div>

            <div>
                <label class="block font-medium mb-1">Harga per Orang</label>
                <input type="number" name="price" class="w-full border-gray-300 rounded-md" required>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full rounded border">
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            <button class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                Simpan
            </button>

            <a href="{{ route('admin.hiking-schedules.index') }}" class="ml-2 text-gray-600 hover:underline">
                Batal
            </a>
        </form>
    </div>
</x-app-layout>
