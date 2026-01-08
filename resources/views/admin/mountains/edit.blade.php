<x-app-layout>
    <div class="p-6 max-w-xl">
        <h1 class="text-xl font-bold mb-4">✏️ Edit Gunung</h1>

        <form method="POST"
              action="{{ route('admin.mountains.update', $mountain) }}">
            @csrf
            @method('PUT')

            <input class="w-full mb-3" name="name"
                   value="{{ $mountain->name }}">

            <input class="w-full mb-3" name="location"
                   value="{{ $mountain->location }}">

            <input class="w-full mb-3" name="height"
                   value="{{ $mountain->height }}">

            <input class="w-full mb-3" name="quota_per_day"
                   value="{{ $mountain->quota_per_day }}">

            <button class="px-4 py-2 bg-green-700 text-white rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
