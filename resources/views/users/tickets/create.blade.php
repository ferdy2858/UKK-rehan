<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🥾 Pesan Tiket Pendakian
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('user.tickets.store') }}" class="bg-white shadow rounded-lg p-6 space-y-6">
            @csrf

            <!-- Jadwal -->
            <div>
                <label class="block mb-1 font-medium">Pilih Jadwal</label>
                <select name="hiking_schedule_id" id="schedule" class="w-full border-gray-300 rounded-md shadow-sm"
                    required>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}" data-price="{{ $schedule->price }}"
                            data-quota="{{ $schedule->remaining_quota }}">
                            {{ $schedule->mountain->name }} —
                            {{ $schedule->date->format('d M Y') }} —
                            Rp {{ number_format($schedule->price) }}/orang —
                            Sisa: {{ $schedule->remaining_quota }}
                        </option>
                    @endforeach
                </select>

            </div>

            <!-- Jumlah -->
            <div>
                <label class="block mb-1 font-medium">Jumlah Pendaki</label>
                <input type="number" name="total_people" min="1"
                    class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Total Harga</label>
                <div class="text-lg font-semibold text-green-700">
                    Rp <span id="totalPrice">0</span>
                </div>
            </div>


            <!-- Members -->
            <div>
                <h3 class="font-semibold mb-2">👥 Data Pendaki</h3>
                <div id="members" class="space-y-3"></div>

                <button type="button" onclick="addMember()" class="text-sm text-green-700 hover:underline mt-2">
                    + Tambah Pendaki
                </button>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
                    Pesan Tiket
                </button>
            </div>
        </form>
    </div>

    <script>
        let index = 0;

        function addMember() {
            document.getElementById('members').insertAdjacentHTML('beforeend', `
            <div class="border rounded p-3">
                <input type="text" name="members[${index}][name]"
                    placeholder="Nama"
                    class="w-full mb-2 border-gray-300 rounded-md" required>

                <input type="text" name="members[${index}][nik]"
                    placeholder="NIK"
                    class="w-full mb-2 border-gray-300 rounded-md" required>

                <input type="text" name="members[${index}][phone]"
                    placeholder="No HP"
                    class="w-full border-gray-300 rounded-md" required>
            </div>
        `);
            index++;
        }

        const scheduleSelect = document.getElementById('schedule');
        const totalPeopleInput = document.querySelector('[name="total_people"]');
        const totalPriceEl = document.getElementById('totalPrice');

        function calculatePrice() {
            const price = scheduleSelect.selectedOptions[0].dataset.price || 0;
            const qty = totalPeopleInput.value || 0;
            totalPriceEl.innerText = (price * qty).toLocaleString('id-ID');
        }

        scheduleSelect.addEventListener('change', calculatePrice);
        totalPeopleInput.addEventListener('input', calculatePrice);
    </script>
</x-app-layout>
