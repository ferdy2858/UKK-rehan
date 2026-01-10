<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
                ✏️ Edit Data Gunung
            </h1>

            <form method="POST" action="{{ route('admin.mountains.update', $mountain) }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label class="block mb-1 font-medium">Nama Gunung</label>
                    <input name="name" value="{{ old('name', $mountain->name) }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block mb-1 font-medium">Lokasi</label>
                    <input name="location" value="{{ old('location', $mountain->location) }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                </div>

                <!-- Tinggi & Kuota -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Tinggi (mdpl)</label>
                        <input type="number" name="height" value="{{ old('height', $mountain->height) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Kuota / Hari</label>
                        <input type="number" name="quota_per_day"
                            value="{{ old('quota_per_day', $mountain->quota_per_day) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>
                </div>

                <!-- Gambar Lama -->
                @if ($mountain->image)
                    <div>
                        <p class="text-sm font-medium mb-2">Gambar Saat Ini</p>
                        <img src="{{ asset('storage/' . $mountain->image) }}"
                            class="w-full h-64 object-cover rounded-xl shadow">
                    </div>
                @endif

                <!-- Upload Gambar Baru -->
                <div>
                    <label class="block mb-2 font-medium">Ganti Gambar (Opsional)</label>

                    <div class="relative">
                        <input id="imageInput" type="file" name="image" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            onchange="previewImage(event)">

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-green-600 transition">
                            <p class="text-gray-500 text-sm">Klik untuk upload gambar baru</p>
                            <p class="text-xs text-gray-400 mt-1">PNG / JPG / JPEG / WEBP</p>
                        </div>
                    </div>
                </div>

                <!-- Preview Gambar Baru -->
                <div id="imagePreviewContainer" class="hidden">
                    <p class="text-sm font-medium mb-2">Preview Gambar Baru</p>
                    <img id="imagePreview" class="w-full h-64 object-cover rounded-xl shadow">
                </div>

                <!-- Button -->
                <div class="pt-4 flex gap-3">
                    <button
                        class="px-6 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg font-semibold transition">
                        💾 Update Data
                    </button>

                    <a href="{{ route('admin.mountains.index') }}"
                        class="px-6 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Preview -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0]
            if (!file) return

            const reader = new FileReader()
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result
                document.getElementById('imagePreviewContainer')
                    .classList.remove('hidden')
            }
            reader.readAsDataURL(file)
        }
    </script>
</x-app-layout>
