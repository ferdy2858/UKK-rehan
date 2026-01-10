<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800">
            🔐 Verifikasi Tiket Pendakian
        </h2>
    </x-slot>

    <div class="py-10 max-w-xl mx-auto">

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('admin.verification.check') }}">
                @csrf

                <label class="block font-medium mb-2">
                    Masukkan Kode Verifikasi
                </label>

                <input type="text" name="verification_code" autofocus
                    class="w-full border rounded p-3 text-lg font-mono tracking-widest" placeholder="ABC123XYZ"
                    required>

                <button class="mt-4 w-full bg-green-700 text-white py-2 rounded hover:bg-green-800">
                    ✅ Verifikasi Tiket
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
