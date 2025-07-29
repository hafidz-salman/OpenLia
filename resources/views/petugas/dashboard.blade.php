<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Papan Misi Harian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        :root {
            --primary-color: #5a67d8;
            --secondary-color: #f8fafc;
            --text-color: #2d3748;
            --light-gray: #f0f0f0;
            --lighter-gray: #fafafa;
            --shadow-color: #d1d5db;
            --success-color: #48bb78;
            --warning-color: #f6ad55;
            --danger-color: #f56565;
        }

        body {
            background-color: var(--light-gray);
            color: var(--text-color);
        }

        .neumorphic-panel {
            background: var(--light-gray);
            border-radius: 16px;
            padding: 24px;
            box-shadow:  8px 8px 16px var(--shadow-color),
                         -8px -8px 16px #ffffff;
            margin-bottom: 24px;
        }

        .glass-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .glass-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(90, 103, 216, 0.2);
        }

        .glass-button.primary {
            background: rgba(90, 103, 216, 0.1);
            color: var(--primary-color);
        }

        .glass-button.primary:hover {
            background: var(--primary-color);
            color: white;
        }

        .progress-container {
            width: 100%;
            height: 24px;
            background: var(--light-gray);
            border-radius: 12px;
            box-shadow: inset 3px 3px 6px var(--shadow-color),
                        inset -3px -3px 6px #ffffff;
            overflow: hidden;
            margin: 16px 0;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-color) 70%, #7f8de8);
            border-radius: 12px;
            transition: width 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 12px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .mission-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin-bottom: 8px;
            background: var(--secondary-color);
            border-radius: 12px;
            box-shadow: 3px 3px 6px var(--shadow-color),
                       -3px -3px 6px #ffffff;
            transition: all 0.3s ease;
        }

        .mission-item:hover {
            transform: translateY(-2px);
            box-shadow: 4px 4px 8px var(--shadow-color),
                       -4px -4px 8px #ffffff;
        }

        .mission-icon {
            margin-right: 12px;
            font-size: 20px;
        }

        .mission-locked {
            opacity: 0.6;
        }

        @media (max-width: 768px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }
            
            .neumorphic-panel {
                padding: 18px;
            }
        }
    </style>
</head>
<body class="min-h-screen p-4 sm:p-6 lg:p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div class="neumorphic-panel">
                <h1 class="text-2xl font-bold text-gray-800">Papan Misi Harian</h1>
                <p class="text-gray-600">Selamat bekerja, {{ Auth::user()->name }}!</p>
            </div>
            
            <!-- Dropdown Profil -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="neumorphic-panel inline-flex items-center px-4 py-2">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50" style="display: none;">
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">
                        Profile
                    </a>
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('petugas.history') }}">
                        Riwayat Pembersihan
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

        <!-- Widget Progres Harian -->
        <div class="neumorphic-panel md:col-span-2">
            <h2 class="text-xl font-semibold mb-4">Progres Misi Hari Ini</h2>
            
            @php
                $totalRooms = $allRooms->count();
                $cleanedRooms = $cleanedTodayIds->count();
                $progress = $totalRooms > 0 ? round(($cleanedRooms / $totalRooms) * 100) : 0;
            @endphp
            
            <div class="flex justify-between mb-2">
                <span class="font-medium">{{ $cleanedRooms }} / {{ $totalRooms }} Ruangan Selesai</span>
                <span class="font-bold">{{ $progress }}%</span>
            </div>
            
            <div class="progress-container">
                <div class="progress-bar" style="width: {{ $progress }}%">
                    {{ $progress }}%
                </div>
            </div>
            
            <p class="text-center mt-4 font-medium">
                @if($progress == 0)
                    🚀 Ayo mulai misinya!
                @elseif($progress < 50)
                    💪 Teruskan semangat!
                @elseif($progress < 100)
                    👍 Kamu hebat, lanjutkan!
                @else
                    🎉 Kerja Bagus! Semua misi selesai!
                @endif
            </p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Widget Misi Tersedia -->
            <div class="neumorphic-panel">
                <h2 class="text-xl font-semibold mb-4">Daftar Misi</h2>
                
                @if($uncleanedRooms->whereNotIn('id', $inUseRoomIds)->count() > 0)
                    <div class="mb-4">
                        @foreach($uncleanedRooms->whereNotIn('id', $inUseRoomIds) as $room)
                            <div class="mission-item">
                                <span class="mission-icon">🧹</span>
                                <span class="flex-grow">{{ $room->nama_ruangan }}</span>
                                @if(!$activeLog)
                                    <form action="{{ route('petugas.cleaning.start', $room) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="glass-button text-sm">Mulai</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    <form action="{{ route('petugas.cleaning.start_all') }}" method="POST">
                        @csrf
                        <button type="submit" class="glass-button primary w-full justify-center">
                            <span class="mr-2">✅</span> Selesaikan Semua Misi Tersedia
                        </button>
                    </form>
                @else
                    <p class="text-center py-4 text-gray-500">Tidak ada misi tersedia saat ini</p>
                @endif
            </div>

            <!-- Widget Misi Terkunci -->
            <div class="neumorphic-panel">
                <h2 class="text-xl font-semibold mb-4">Misi Terkunci</h2>
                
                @if($uncleanedRooms->whereIn('id', $inUseRoomIds)->count() > 0)
                    @foreach($uncleanedRooms->whereIn('id', $inUseRoomIds) as $room)
                        <div class="mission-item mission-locked">
                            <span class="mission-icon">🔒</span>
                            <span class="flex-grow">{{ $room->nama_ruangan }}</span>
                            <span class="text-sm text-gray-500">Sedang digunakan</span>
                        </div>
                    @endforeach
                @else
                    <p class="text-center py-4 text-gray-500">Tidak ada misi terkunci</p>
                @endif
            </div>
        </div>

        <!-- Widget Misi Selesai -->
        <div class="neumorphic-panel">
            <h2 class="text-xl font-semibold mb-4">Misi Selesai Hari Ini</h2>
            
            @if($cleanedTodayIds->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($allRooms->whereIn('id', $cleanedTodayIds) as $room)
                        <div class="mission-item">
                            <span class="mission-icon">✅</span>
                            <span>{{ $room->nama_ruangan }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center py-4 text-gray-500">Belum ada misi yang selesai hari ini</p>
            @endif
        </div>

        <!-- Current Active Mission -->
        @if($activeLog)
        <div class="neumorphic-panel mt-6 bg-green-50">
            <h2 class="text-xl font-semibold mb-4">Misi Aktif</h2>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="mission-icon text-2xl">🧹</span>
                    <div>
                        <h3 class="font-medium">{{ $activeLog->room->nama_ruangan }}</h3>
                        <p class="text-sm text-gray-600">Dimulai: {{ $activeLog->start_time->format('H:i') }}</p>
                    </div>
                </div>
                <form action="{{ route('petugas.cleaning.end', $activeLog) }}" method="POST">
                    @csrf
                    <button type="submit" class="glass-button primary">
                        <span class="mr-2">🏁</span> Tandai Selesai
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</body>
</html>
