<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
                ✏️ Edit Jadwal Pendakian
            </h1>

            <form method="POST" action="{{ route('admin.hiking-schedules.update', $hikingSchedule) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Gunung -->
                <div>
                    <label class="block mb-1 font-medium">Gunung</label>
                    <select name="mountain_id"
                        class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                        @foreach ($mountains as $mountain)
                            <option value="{{ $mountain->id }}" @selected($hikingSchedule->mountain_id == $mountain->id)>
                                {{ $mountain->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Tanggal Mulai</label>
                        <input type="date" name="start_date"
                            value="{{ $hikingSchedule->start_date->format('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ $hikingSchedule->end_date->format('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>
                </div>

                <!-- Kuota & Harga -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Kuota / Hari</label>
                        <input type="number" name="quota" min="1" value="{{ $hikingSchedule->quota }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Harga / Orang</label>
                        <input type="number" name="price" min="1" value="{{ $hikingSchedule->price }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600"
                            required>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block mb-1 font-medium">Status</label>
                    <select name="status"
                        class="w-full rounded-lg border-gray-300 focus:ring-green-600 focus:border-green-600" required>
                        <option value="open" @selected($hikingSchedule->status === 'open')>
                            🟢 Open
                        </option>
                        <option value="closed" @selected($hikingSchedule->status === 'closed')>
                            🔴 Closed
                        </option>
                    </select>
                </div>

                <!-- Button -->
                <div class="pt-4 flex gap-3">
                    <button
                        class="px-6 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg font-semibold transition">
                        💾 Update Jadwal
                    </button>

                    <a href="{{ route('admin.hiking-schedules.index') }}"
                        class="px-6 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
