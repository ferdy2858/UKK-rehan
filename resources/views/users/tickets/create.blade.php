<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🥾 Pesan Tiket Pendakian
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('user.tickets.store') }}" class="space-y-6">
            @csrf

            <!-- CARD PREVIEW GUNUNG -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative h-72">
                    <img id="mountainImage" class="w-full h-full object-cover" src="" alt="Preview Gunung">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h3 id="mountainName" class="text-3xl font-bold mb-2">Pilih Jadwal Pendakian</h3>
                        <p id="mountainDate" class="text-lg opacity-90"></p>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                        <span class="text-sm font-semibold text-gray-700">Sisa Kuota: <span id="quotaBadge"
                                class="text-green-600">-</span></span>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- PILIH JADWAL -->
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-gray-700">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Pilih Jadwal Pendakian
                        </label>
                        <select name="hiking_schedule_id" id="schedule"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            required>
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->id }}" data-price="{{ $schedule->price }}"
                                    data-quota="{{ $schedule->remaining_quota }}"
                                    data-start="{{ $schedule->start_date }}" data-end="{{ $schedule->end_date }}"
                                    data-mountain="{{ $schedule->mountain->name }}"
                                    data-image="{{ $schedule->mountain->image
                                        ? asset('storage/' . $schedule->mountain->image)
                                        : asset('images/mountain-placeholder.jpg') }}">
                                    {{ $schedule->mountain->name }} —
                                    {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M') }} -
                                    {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }} —
                                    Rp {{ number_format($schedule->price) }}/orang —
                                    Sisa: {{ $schedule->remaining_quota }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- TANGGAL MENDAKI -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Tanggal Mendaki
                            </label>
                            <input type="date" name="hike_date" id="hikeDate"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                required>
                        </div>

                        <!-- JUMLAH PENDAKI -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Jumlah Pendaki
                            </label>
                            <input type="number" name="total_people" id="totalPeople" min="1"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                required>
                        </div>
                    </div>

                    <!-- TOTAL HARGA -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border-2 border-green-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Pembayaran</p>
                                <div class="text-3xl font-bold text-green-700">
                                    Rp <span id="totalPrice">0</span>
                                </div>
                            </div>
                            <div class="bg-white p-3 rounded-full shadow-md">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DATA PENDAKI -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="flex items-center mb-6">
                    <div class="bg-green-100 p-3 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Data Pendaki</h3>
                        <p class="text-sm text-gray-500">Masukkan data lengkap setiap pendaki</p>
                    </div>
                </div>

                <div id="members" class="space-y-4"></div>

                <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-400 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-blue-400 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm text-blue-700">
                            Pastikan data yang dimasukkan sesuai dengan identitas resmi. Jumlah data pendaki harus sama
                            dengan jumlah pendaki yang dipilih.
                        </p>
                    </div>
                </div>
            </div>

            <!-- TOMBOL SUBMIT -->
            <div class="flex justify-end">
                <button type="submit"
                    class="group relative bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                    <span>Pesan Tiket Sekarang</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
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
        const mountainName = document.getElementById('mountainName');
        const mountainDate = document.getElementById('mountainDate');
        const quotaBadge = document.getElementById('quotaBadge');
        const membersEl = document.getElementById('members');
        const hikeDateInput = document.getElementById('hikeDate');

        function updateUI() {
            const selected = scheduleSelect.selectedOptions[0];

            const price = Number(selected.dataset.price || 0);
            const qty = Number(totalPeopleInput.value || 0);
            const quota = selected.dataset.quota;
            const startDate = selected.dataset.start;
            const endDate = selected.dataset.end;
            const mountainNameText = selected.dataset.mountain;

            totalPriceEl.innerText = (price * qty).toLocaleString('id-ID');
            mountainImage.src = selected.dataset.image;
            mountainName.innerText = mountainNameText;
            quotaBadge.innerText = quota;

            const start = new Date(startDate).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long'
            });
            const end = new Date(endDate).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            mountainDate.innerText = `${start} - ${end}`;

            hikeDateInput.min = startDate;
            hikeDateInput.max = endDate;

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
                <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-green-300 transition-colors bg-gradient-to-br from-gray-50 to-white">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 text-green-700 w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg mr-3">
                            ${i + 1}
                        </div>
                        <h4 class="font-semibold text-gray-700">Pendaki ${i + 1}</h4>
                    </div>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Nama Lengkap</label>
                            <input type="text"
                                   name="members[${i}][name]"
                                   placeholder="Masukkan nama lengkap"
                                   class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                   required>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text"
                                   name="members[${i}][nik]"
                                   placeholder="16 digit NIK"
                                   maxlength="16"
                                   class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                   required>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Nomor Telepon</label>
                            <input type="text"
                                   name="members[${i}][phone]"
                                   placeholder="08xx xxxx xxxx"
                                   class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                   required>
                        </div>
                    </div>
                </div>
            `);
            }
        }

        updateUI();

        scheduleSelect.addEventListener('change', updateUI);
        totalPeopleInput.addEventListener('input', updateUI);
    </script>
</x-app-layout>
