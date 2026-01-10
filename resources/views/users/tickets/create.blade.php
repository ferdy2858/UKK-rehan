<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🥾 Pesan Tiket Pendakian
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('user.tickets.store') }}" class="bg-white shadow rounded-lg p-6 space-y-6">
            @csrf

            <!-- PREVIEW GAMBAR GUNUNG -->
            <div>
                <img id="mountainImage" class="w-full h-56 object-cover rounded-lg border" src=""
                    alt="Preview Gunung">
            </div>

            <!-- PILIH JADWAL -->
            <div>
                <label class="block mb-1 font-medium">Pilih Jadwal</label>
                <select name="hiking_schedule_id" id="schedule" class="w-full border-gray-300 rounded-md shadow-sm"
                    required>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}" data-price="{{ $schedule->price }}"
                            data-quota="{{ $schedule->remaining_quota }}" data-start="{{ $schedule->start_date }}"
                            data-end="{{ $schedule->end_date }}"
                            data-image="{{ $schedule->mountain->image
                                ? asset('storage/' . $schedule->mountain->image)
                                : asset('images/mountain-placeholder.jpg') }}">
                            {{ $schedule->mountain->name }} —
                            {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M') }}
                            -
                            {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }} —
                            Rp {{ number_format($schedule->price) }}/orang —
                            Sisa: {{ $schedule->remaining_quota }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- TANGGAL MENDAKI -->
            <div>
                <label class="block mb-1 font-medium">Tanggal Mendaki</label>
                <input type="date" name="hike_date" id="hikeDate"
                    class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- JUMLAH PENDAKI -->
            <div>
                <label class="block mb-1 font-medium">Jumlah Pendaki</label>
                <input type="number" name="total_people" id="totalPeople" min="1"
                    class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- TOTAL HARGA -->
            <div>
                <label class="block mb-1 font-medium">Total Harga</label>
                <div class="text-lg font-semibold text-green-700">
                    Rp <span id="totalPrice">0</span>
                </div>
            </div>

            <!-- DATA PENDAKI -->
            <div>
                <h3 class="font-semibold mb-2">👥 Data Pendaki</h3>

                <div id="members" class="space-y-3"></div>

                <p class="text-sm text-gray-500">
                    Jumlah pendaki harus sesuai dengan jumlah data pendaki
                </p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                    Pesan Tiket
                </button>
            </div>
        </form>
    </div>

    <!-- SCRIPT -->
    <script>
        const scheduleSelect = document.getElementById('schedule');
        const totalPeopleInput = document.getElementById('totalPeople');
        const totalPriceEl = document.getElementById('totalPrice');
        const mountainImage = document.getElementById('mountainImage');
        const membersEl = document.getElementById('members');
        const hikeDateInput = document.getElementById('hikeDate');

        function updateUI() {
            const selected = scheduleSelect.selectedOptions[0];

            const price = Number(selected.dataset.price || 0);
            const qty = Number(totalPeopleInput.value || 0);

            totalPriceEl.innerText =
                (price * qty).toLocaleString('id-ID');

            mountainImage.src = selected.dataset.image;

            // SET RANGE TANGGAL MENDAKI
            hikeDateInput.min = selected.dataset.start;
            hikeDateInput.max = selected.dataset.end;

            // reset tanggal kalau di luar range
            if (
                hikeDateInput.value &&
                (hikeDateInput.value < hikeDateInput.min ||
                    hikeDateInput.value > hikeDateInput.max)
            ) {
                hikeDateInput.value = '';
            }

            syncMembers(qty);
        }

        function syncMembers(count) {
            membersEl.innerHTML = '';

            for (let i = 0; i < count; i++) {
                membersEl.insertAdjacentHTML('beforeend', `
                <div class="border rounded p-3">
                    <input type="text"
                           name="members[${i}][name]"
                           placeholder="Nama Pendaki"
                           class="w-full mb-2 border-gray-300 rounded-md"
                           required>

                    <input type="text"
                           name="members[${i}][nik]"
                           placeholder="NIK"
                           class="w-full mb-2 border-gray-300 rounded-md"
                           required>

                    <input type="text"
                           name="members[${i}][phone]"
                           placeholder="No HP"
                           class="w-full border-gray-300 rounded-md"
                           required>
                </div>
            `);
            }
        }

        // init
        updateUI();

        scheduleSelect.addEventListener('change', updateUI);
        totalPeopleInput.addEventListener('input', updateUI);
    </script>
</x-app-layout>
