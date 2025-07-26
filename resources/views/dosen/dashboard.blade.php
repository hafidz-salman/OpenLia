<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Mahasiswa</h1>
                <p class="text-gray-500">Selamat datang, {{ Auth::user()->name }}!</p>
            </div>
            
            <!-- Dropdown Profil & Logout -->
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Widget Jadwal Kuliah (Besar) -->
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="md:col-span-2 bg-indigo-500 text-white p-6 rounded-lg shadow-lg hover:bg-indigo-600 transition flex flex-col justify-between">
                <div>
                    <h3 class="text-xl font-bold">Jadwal Kuliah Saya</h3>
                    <p class="mt-2 opacity-80">Lihat jadwal mata kuliah Anda yang relevan berdasarkan prodi dan angkatan.</p>
                </div>
                <div class="text-right mt-4 text-4xl font-black opacity-20">🎓</div>
            </a>

            <!-- Widget Scan Ruangan -->
            <a href="{{ route('scanner.show') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
                <h3 class="font-semibold text-gray-800">Scan Ruangan</h3>
                <p class="text-sm text-gray-500 mt-1">Gunakan kamera untuk akses cepat ke ruangan.</p>
            </a>

            <!-- Widget Booking Ruangan -->
            <a href="{{ route('booking.create') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
                <h3 class="font-semibold text-gray-800">Booking Ruangan</h3>
                <p class="text-sm text-gray-500 mt-1">Ajukan peminjaman untuk acara atau kegiatan khusus.</p>
            </a>
            
            <!-- Widget Riwayat Permintaan -->
            <a href="{{ route('mahasiswa.history.index') }}" class="md:col-span-2 bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition">
                <h3 class="font-semibold text-gray-800">Riwayat Permintaan Saya</h3>
                <p class="text-sm text-gray-500 mt-1">Lacak status semua permintaan peminjaman ruangan yang Anda ajukan.</p>
            </a>

        </div>
    </div>

</body>
</html>
