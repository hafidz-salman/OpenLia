<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: {
                            100: '#E5E9F2',
                            200: '#D8DEE9',
                            300: '#4C566A',
                            400: '#434C5E',
                            500: '#3B4252',
                            600: '#2E3440',
                        },
                        light: {
                            bg: '#e0e5ec',
                            highlight: '#ffffff',
                            shadow: '#a3b1c6'
                        }
                    },
                    boxShadow: {
                        'neumorphic-sm': '3px 3px 6px #a3b1c6, -3px -3px 6px #ffffff',
                        'neumorphic-md': '8px 8px 16px #a3b1c6, -8px -8px 16px #ffffff',
                        'neumorphic-lg': '12px 12px 24px #a3b1c6, -12px -12px 24px #ffffff',
                        'neumorphic-inset': 'inset 3px 3px 6px #a3b1c6, inset -3px -3px 6px #ffffff',
                        'neumorphic-dark-sm': '3px 3px 6px #2a2e38, -3px -3px 6px #363a46',
                        'neumorphic-dark-md': '8px 8px 16px #2a2e38, -8px -8px 16px #363a46',
                        'neumorphic-dark-inset': 'inset 3px 3px 6px #2a2e38, inset -3px -3px 6px #363a46'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #e0e5ec;
            font-family: 'Inter', sans-serif;
        }
        
        .neumorphic-light {
            background: #e0e5ec;
            box-shadow: 8px 8px 16px #a3b1c6, -8px -8px 16px #ffffff;
            border-radius: 12px;
        }
        
        .neumorphic-dark {
            background: #3B4252;
            box-shadow: 8px 8px 16px #2a2e38, -8px -8px 16px #363a46;
            border-radius: 12px;
        }
        
        .sidebar-item {
            transition: all 0.2s ease;
        }
        
        .sidebar-item:hover {
            box-shadow: inset 3px 3px 6px #2a2e38, inset -3px -3px 6px #363a46;
        }
        
        .sidebar-item.active {
            box-shadow: inset 3px 3px 6px #2a2e38, inset -3px -3px 6px #363a46;
            border-left: 3px solid #5E81AC;
        }
        
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Mobile menu toggle */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                position: fixed;
                z-index: 50;
                height: 100vh;
            }
            .sidebar-open {
                transform: translateX(0);
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 40;
            }
            .overlay-open {
                display: block;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col md:flex-row">
    <!-- Mobile Menu Button -->
    <button id="mobileMenuButton" class="md:hidden fixed top-4 left-4 z-30 bg-dark-600 p-2 rounded-lg text-white">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Overlay for mobile menu -->
    <div id="overlay" class="overlay"></div>

    <!-- Sidebar Navigation -->
    <div id="sidebar" class="sidebar w-72 bg-dark-600 p-4 flex flex-col shadow-xl z-20">
        <!-- Sidebar Header -->
        <div class="flex items-center space-x-3 p-4 mb-8">
            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xl">OL</div>
            <h1 class="text-xl font-bold text-dark-200">OpenLia</h1>
        </div>
        
        <!-- Navigation Groups -->
        <div class="flex-1 flex flex-col space-y-2">
            <!-- Main Menu -->
            <div class="mb-6">
                <h3 class="text-xs uppercase text-dark-300 font-semibold mb-3 px-4">Menu Utama</h3>
                <a href="#" class="sidebar-item active flex items-center space-x-3 p-3 text-dark-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </div>
            
            <!-- Management Menu -->
            <div class="mb-6">
                <h3 class="text-xs uppercase text-dark-300 font-semibold mb-3 px-4">Menu Manajemen</h3>
                
                <a href="{{ route('admin.prodi.index') }}" class="sidebar-item flex items-center space-x-3 p-3 text-dark-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>Manajemen Prodi</span>
                </a>
                
                <a href="{{ route('admin.rooms.index') }}" class="sidebar-item flex items-center space-x-3 p-3 text-dark-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>Manajemen Ruangan</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="sidebar-item flex items-center space-x-3 p-3 text-dark-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Manajemen User</span>
                </a>
                
                <a href="{{ route('admin.schedules.index') }}" class="sidebar-item flex items-center space-x-3 p-3 text-dark-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Manajemen Jadwal</span>
                </a>
            </div>
            
            <!-- Action Menu -->
            <div class="mb-6">
                <h3 class="text-xs uppercase text-dark-300 font-semibold mb-3 px-4">Menu Aksi</h3>
                
                <a href="{{ route('admin.requests.index') }}" class="sidebar-item flex items-center justify-between p-3 text-dark-200">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <span>Permintaan Ruangan</span>
                    </div>
                    @if($pendingRoomRequests > 0)
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $pendingRoomRequests }}</span>
                    @endif
                </a>
            </div>
        </div>
        
        <!-- Sidebar Footer - Profile & Logout -->
        <div x-data="{ open: false }" class="relative mt-auto">
            <button @click="open = ! open" class="sidebar-item w-full flex items-center justify-between p-3 text-dark-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" @click.away="open = false" class="absolute bottom-16 left-0 right-0 bg-dark-500 rounded-md shadow-lg py-1 z-50" style="display: none;">
                <a class="block px-4 py-2 text-sm text-dark-200 hover:bg-dark-400" href="{{ route('profile.edit') }}">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-dark-200 hover:bg-dark-400">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="flex-1 overflow-y-auto">
        <!-- Content Header -->
        <div class="bg-light-bg p-4 sm:p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div class="mb-3 sm:mb-0">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard</h1>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="#" class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-700 hover:text-blue-600">
                                    <svg class="w-3 h-3 mr-1 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-xs sm:text-sm font-medium text-gray-500 md:ml-2">Dashboard</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                </div>
            </div>
        </div>
        
        <!-- Bento Grid Layout -->
        <div class="p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Widget Total Pengguna -->
            <div class="neumorphic-light p-4 sm:p-6 rounded-xl flex items-center">
                <div class="bg-blue-100 p-2 sm:p-3 rounded-full shadow-inner mr-3 sm:mr-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm text-gray-500 font-medium">Total Pengguna</h3>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</p>
                </div>
            </div>
            
            <!-- Widget Ruangan Terpakai -->
            <div class="neumorphic-light p-4 sm:p-6 rounded-xl flex items-center">
                <div class="bg-red-100 p-2 sm:p-3 rounded-full shadow-inner mr-3 sm:mr-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm text-gray-500 font-medium">Ruangan Terpakai</h3>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-red-500 mt-1">{{ $roomsInUseCount }}</p>
                </div>
            </div>
            
            <!-- Widget Ruangan Tersedia -->
            <div class="neumorphic-light p-4 sm:p-6 rounded-xl flex items-center">
                <div class="bg-green-100 p-2 sm:p-3 rounded-full shadow-inner mr-3 sm:mr-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm text-gray-500 font-medium">Ruangan Tersedia</h3>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-green-500 mt-1">{{ $availableRoomsCount }}</p>
                </div>
            </div>
            
            <!-- Widget Permintaan Baru -->
            <a href="{{ route('admin.requests.index') }}" class="neumorphic-light p-4 sm:p-6 rounded-xl flex items-center hover:shadow-inner transition">
                <div class="bg-yellow-100 p-2 sm:p-3 rounded-full shadow-inner mr-3 sm:mr-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm text-gray-500 font-medium">Permintaan Baru</h3>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-yellow-600 mt-1">{{ $pendingRoomRequests }}</p>
                </div>
            </a>
            
            <!-- Widget Jadwal Hari Ini (Lebih Besar) -->
            <div class="sm:col-span-2 lg:col-span-4 neumorphic-light p-4 sm:p-6 rounded-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 sm:mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">Jadwal Hari Ini ({{ $todayName }})</h3>
                    <a href="{{ route('admin.schedules.index') }}" class="text-xs sm:text-sm text-blue-600 hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-y-auto max-h-64 sm:max-h-96 scrollbar-hide">
                    @forelse ($schedulesToday as $schedule)
                        <div class="neumorphic-light p-3 sm:p-4 mb-2 sm:mb-3 rounded-lg flex items-start">
                            <div class="bg-blue-100 p-1 sm:p-2 rounded-lg mr-3 sm:mr-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-sm sm:text-base text-gray-800">{{ date('H:i', strtotime($schedule->jam_mulai)) }} - {{ date('H:i', strtotime($schedule->jam_selesai)) }}</p>
                                <p class="text-xs sm:text-sm text-gray-700">{{ $schedule->mata_kuliah }}</p>
                                <p class="text-xs text-gray-500">{{ $schedule->room->nama_ruangan }} - {{ $schedule->user->name }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="neumorphic-light p-3 sm:p-4 rounded-lg text-center">
                            <p class="text-sm text-gray-500">Tidak ada jadwal untuk hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- WIDGET PENGGANTI: Feed Aktivitas Terbaru -->
            <div class="md:col-span-2 lg:col-span-2 neumorphic-light p-6 rounded-xl">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Feed Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    @forelse ($sortedFeed as $activity)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 bg-{{$activity->color}}-100 rounded-full flex items-center justify-center shadow-neumorphic-light-inset">
                                <i class="fas {{$activity->icon}} text-{{$activity->color}}-600"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-800">
                                    <strong>{{ $activity->user_name }}</strong> {!! $activity->action !!}
                                </p>
                                <p class="text-xs text-gray-500">{{ $activity->time->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada aktivitas yang tercatat.</p>
                    @endforelse
                </div>
            </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('overlay-open');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('overlay-open');
        });

        // Notifikasi untuk pesan sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false,
                background: '#e0e5ec'
            });
        @endif
    </script>
</body>
</html>