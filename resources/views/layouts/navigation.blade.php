<nav class="flex flex-col h-full text-green-900">

    <!-- User Info -->
    <div class="px-4 py-4 border-b border-green-700/40">
        <div class="font-semibold text-lg">
            {{ auth()->user()->name }}
        </div>
        <div class="text-sm text-green-700">
            {{ auth()->user()->email }}
        </div>
    </div>

    @php
        $isAdmin = auth()->user()->role === 'admin';

        $dashboardRoute = $isAdmin ? 'admin.dashboard' : 'user.dashboard';
    @endphp

    <!-- Menu -->
    <div class="flex-1 py-4 space-y-1">

        <!-- Dashboard -->
        <a href="{{ route($dashboardRoute) }}"
            class="block px-4 py-2 rounded-md transition
           {{ request()->routeIs($dashboardRoute) ? 'bg-green-700 text-white' : 'hover:bg-green-100' }}">
            🧭 Dashboard
        </a>

        <!-- USER MENU -->
        @unless ($isAdmin)
            <a href="{{ route('user.tickets.index') }}" class="block px-4 py-2 rounded-md hover:bg-green-100 transition">
                🥾 Pesan Tiket
            </a>

            <a href="#" class="block px-4 py-2 rounded-md hover:bg-green-100 transition">
                🎟️ Tiket Saya
            </a>
        @endunless

        <!-- ADMIN MENU -->
        @if ($isAdmin)
            <div class="mt-4 px-4 text-xs font-semibold text-green-700 uppercase">
                Admin
            </div>

            <a href="{{ route('admin.mountains.index') }}"
                class="block px-4 py-2 rounded-md transition
                {{ request()->routeIs('admin.mountains.*') ? 'bg-green-700 text-white' : 'hover:bg-green-100' }}">
                🏔️ Gunung
            </a>


            <a href="{{ route('admin.hiking-schedules.index') }}"
                class="block px-4 py-2 rounded-md transition
                {{ request()->routeIs('admin.hiking-schedules.*') ? 'bg-green-700 text-white' : 'hover:bg-green-100' }}">
                📅 Jadwal Pendakian
            </a>


            <a href="{{ route('admin.tickets.index')}}" class="block px-4 py-2 rounded-md transition
            {{ request()->routeIs('admin.tickets.*') ? 'bg-green-700 text-white' : 'hover:bg-green-100' }}">
                ✅ Validasi Tiket
            </a>
        @endif

        <!-- SHARED -->
        <a href="{{ route('profile.edit') }}"
            class="block px-4 py-2 rounded-md transition
           {{ request()->routeIs('profile.*') ? 'bg-green-700 text-white' : 'hover:bg-green-100' }}">
            👤 Profile
        </a>
    </div>

    <!-- Logout -->
    <div class="px-4 py-4 border-t border-green-700/40">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-2 rounded-md
                       text-red-600 hover:bg-red-50 transition">
                🚪 <span class="font-medium">Log Out</span>
            </button>
        </form>
    </div>

</nav>
