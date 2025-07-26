<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Petugas Kebersihan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Petugas</h1>
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

        <!-- Notifikasi Cerdas -->
        @if ($uncleanedRooms->isEmpty())
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow" role="alert">
                <p class="font-bold">Kerja Bagus!</p>
                <p>Semua ruangan telah dibersihkan hari ini.</p>
            </div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg shadow" role="alert">
                <p class="font-bold">Pengingat</p>
                <p>Masih ada <strong>{{ $uncleanedRooms->count() }}</strong> ruangan yang belum dibersihkan hari ini. Ruangan yang tersedia untuk dibersihkan:</p>
                <ul class="list-disc list-inside mt-2 text-sm">
                    @foreach($uncleanedRooms->whereNotIn('id', $inUseRoomIds) as $room)
                        <li>{{ $room->nama_ruangan }}</li>
                    @endforeach
                </ul>
            </div>
            <form action="{{ route('petugas.cleaning.start_all') }}" method="POST" class="mb-6">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Tandai Semua Ruangan Tersedia Selesai</button>
            </form>
        @endif

        <!-- Daftar Ruangan -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Ruangan</th>
                        <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Status Jadwal</th>
                        <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Status Kebersihan</th>
                        <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $allRooms = \App\Models\Room::orderBy('nama_ruangan')->get(); @endphp
                    @foreach($allRooms as $room)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $room->nama_ruangan }}</td>
                        <td class="px-5 py-4 border-b border-gray-200 text-sm">
                            @if($inUseRoomIds->contains($room->id))
                                <span class="text-red-600 font-semibold">Sedang Digunakan</span>
                            @else
                                <span class="text-green-600">Kosong</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 border-b border-gray-200 text-sm">
                            @if($cleanedTodayIds->contains($room->id))
                                <span class="text-green-600 font-semibold">Sudah Dibersihkan</span>
                            @else
                                <span class="text-yellow-600">Belum Dibersihkan</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 border-b border-gray-200 text-sm">
                            @if($activeLog && $activeLog->room_id == $room->id)
                                <form action="{{ route('petugas.cleaning.end', $activeLog) }}" method="POST">@csrf<button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Selesai</button></form>
                            @elseif($cleanedTodayIds->contains($room->id))
                                <span class="text-gray-500">Telah Selesai</span>
                            @elseif($inUseRoomIds->contains($room->id))
                                <span class="text-gray-500">Tidak Bisa</span>
                            @elseif(!$activeLog)
                                <form action="{{ route('petugas.cleaning.start', $room) }}" method="POST">@csrf<button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Mulai</button></form>
                            @else
                                <span class="text-gray-500">Selesaikan Lainnya</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
