<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
                <p class="text-gray-500">Selamat datang kembali, {{ Auth::user()->name }}!</p>
            </div>
            
            <!-- Dropdown Profil & Logout (YANG DITAMBAHKAN) -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = ! open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none ring-1 ring-gray-200 shadow-sm">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </div>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50" style="display: none;">
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Widget Total Pengguna -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm font-medium">Total Pengguna</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
            </div>

            <!-- Widget Ruangan Terpakai -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm font-medium">Ruangan Terpakai</h3>
                <p class="text-3xl font-bold text-red-500 mt-2">{{ $roomsInUseCount }}</p>
            </div>

            <!-- Widget Ruangan Tersedia -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 text-sm font-medium">Ruangan Tersedia</h3>
                <p class="text-3xl font-bold text-green-500 mt-2">{{ $availableRoomsCount }}</p>
            </div>

            <!-- Widget Permintaan Baru -->
            <a href="{{ route('admin.requests.index') }}" class="bg-yellow-400 p-6 rounded-lg shadow-md hover:bg-yellow-500 transition">
                <h3 class="text-yellow-800 text-sm font-medium">Permintaan Baru</h3>
                <p class="text-3xl font-bold text-yellow-900 mt-2">{{ $pendingRoomRequests }}</p>
            </a>

            <!-- Widget Jadwal Hari Ini (Lebih Besar) -->
            <div class="md:col-span-2 lg:col-span-4 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Hari Ini ({{ $todayName }})</h3>
                <div class="overflow-y-auto max-h-96">
                    @forelse ($schedulesToday as $schedule)
                        <div class="border-l-4 border-blue-500 pl-4 py-2 mb-3">
                            <p class="font-bold">{{ date('H:i', strtotime($schedule->jam_mulai)) }} - {{ date('H:i', strtotime($schedule->jam_selesai)) }}</p>
                            <p class="text-gray-700">{{ $schedule->mata_kuliah }}</p>
                            <p class="text-sm text-gray-500">{{ $schedule->room->nama_ruangan }} - {{ $schedule->user->name }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada jadwal untuk hari ini.</p>
                    @endforelse
                </div>
            </div>

            <!-- Widget Navigasi Cepat (Lebih Besar) -->
            <div class="md:col-span-2 lg:col-span-4 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Navigasi Cepat</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.prodi.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">Manajemen Prodi</a>
                    <a href="{{ route('admin.rooms.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">Manajemen Ruangan</a>
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">Manajemen User</a>
                    <a href="{{ route('admin.schedules.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">Manajemen Jadwal</a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
