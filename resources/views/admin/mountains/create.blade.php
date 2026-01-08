<x-app-layout>
    <div class="p-6 max-w-xl">
        <h1 class="text-xl font-bold mb-4">➕ Tambah Gunung</h1>

        <form method="POST" action="{{ route('admin.mountains.store') }}">
            @csrf

            <input class="w-full mb-3" name="name" placeholder="Nama Gunung">
            <input class="w-full mb-3" name="location" placeholder="Lokasi">
            <input class="w-full mb-3" name="height" type="number" placeholder="Tinggi">
            <input class="w-full mb-3" name="quota_per_day" type="number" placeholder="Kuota per Hari">

            <button class="px-4 py-2 bg-green-700 text-white rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
