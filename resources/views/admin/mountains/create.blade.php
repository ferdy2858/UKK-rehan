<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
                🏔️ Tambah Data Gunung
            </h1>

            <form method="POST" action="{{ route('admin.mountains.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <!-- Nama Gunung -->
                <div>
                    <label class="block mb-1 font-medium">Nama Gunung</label>
                    <input name="name" placeholder="Contoh: Gunung Merapi"
                        class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block mb-1 font-medium">Lokasi</label>
                    <input name="location" placeholder="Contoh: Jawa Tengah"
                        class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                </div>

                <!-- Tinggi & Kuota -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Tinggi (mdpl)</label>
                        <input type="number" name="height" placeholder="Contoh: 2968"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Kuota / Hari</label>
                        <input type="number" name="quota_per_day" placeholder="Contoh: 300"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label class="block mb-2 font-medium">Gambar Gunung</label>

                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center cursor-pointer hover:border-green-600 transition"
                        onclick="document.getElementById('imageInput').click()">
                        <p class="text-gray-500 text-sm">Klik untuk upload gambar</p>
                        <p class="text-xs text-gray-400 mt-1">PNG / JPG / JPEG</p>
                    </div>

                    <input id="imageInput" type="file" name="image" accept="image/*" class="hidden"
                        onchange="previewImage(event)">
                </div>

                <!-- Preview -->
                <div id="imagePreviewContainer" class="hidden">
                    <p class="text-sm font-medium mb-2">Preview Gambar:</p>
                    <img id="imagePreview" class="w-full h-64 object-cover rounded-xl shadow">
                </div>

                <!-- Button -->
                <div class="pt-4">
                    <button
                        class="w-full md:w-auto px-6 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg font-semibold transition">
                        💾 Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Preview Image -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0]
            if (!file) return

            const reader = new FileReader()
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview')
                const container = document.getElementById('imagePreviewContainer')

                preview.src = e.target.result
                container.classList.remove('hidden')
            }
            reader.readAsDataURL(file)
        }
    </script>
</x-app-layout>
