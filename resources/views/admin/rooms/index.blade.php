<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
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
                        'neumorphic-inset': 'inset 2px 2px 5px #a3b1c6, inset -2px -2px 5px #ffffff'
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
        
        .glass-button {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .glass-button:hover {
            background: rgba(59, 130, 246, 0.8);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .import-button {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .import-button:hover {
            background: rgba(34, 197, 94, 0.8);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .room-card {
            transition: all 0.3s ease;
        }
        
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(163, 177, 198, 0.5);
        }
        
        .action-button {
            transition: all 0.2s ease;
            color: #6b7280;
        }
        
        .action-button:hover {
            transform: scale(1.1);
        }
        
        .action-button.override:hover {
            color: #8b5cf6;
        }
        
        .action-button.view:hover {
            color: #3b82f6;
        }
        
        .action-button.edit:hover {
            color: #f59e0b;
        }
        
        .action-button.delete:hover {
            color: #ef4444;
        }
        
        .status-available { background-color: #D1FAE5; color: #065F46; }
        .status-occupied { background-color: #FEE2E2; color: #991B1B; }
        .status-maintenance { background-color: #FEF3C7; color: #92400E; }
    </style>
</head>
<body class="min-h-screen p-8">

    <!-- Content Header -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Ruangan</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Admin
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Manajemen Ruangan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="glass-button text-gray-700 font-semibold py-2 px-4 rounded-lg">
                Dashboard
            </a>
            <a href="{{ route('admin.rooms.create') }}" class="glass-button text-white bg-blue-600 hover:bg-blue-700 font-semibold py-2 px-4 rounded-lg">
                Tambah Ruangan
            </a>
        </div>
    </div>

    <!-- Filter Panel -->
    <div class="neumorphic-light rounded-xl p-6 mb-8">
        <form method="GET" action="{{ route('admin.rooms.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <!-- Search Input -->
                <div class="md:col-span-2">
                    <label for="search" class="sr-only">Cari Ruangan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input id="search" name="search" type="text" class="input-field block w-full pl-10 pr-3 py-2 rounded-lg" 
                               placeholder="Cari berdasarkan nama ruangan..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <!-- Building Filter -->
                <div>
                    <label for="gedung" class="sr-only">Gedung</label>
                    <select id="gedung" name="gedung" class="input-field py-2 px-3 rounded-lg">
                        <option value="">Semua Gedung</option>
                        @foreach($gedungs as $item)
                            <option value="{{ $item->gedung }}" {{ request('gedung') == $item->gedung ? 'selected' : '' }}>
                                {{ $item->gedung }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label for="status" class="sr-only">Status</label>
                    <select id="status" name="status" class="input-field py-2 px-3 rounded-lg">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $item)
                            <option value="{{ $item->status }}" {{ request('status') == $item->status ? 'selected' : '' }}>
                                {{ $item->status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Action Buttons -->
                <div class="md:col-start-4 flex justify-end space-x-2">
                    <button type="submit" class="glass-button text-white bg-blue-600 hover:bg-blue-700 font-semibold py-2 px-4 rounded-lg">
                        Filter
                    </button>
                    <a href="{{ route('admin.rooms.index') }}" class="glass-button text-gray-700 font-semibold py-2 px-4 rounded-lg">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Success Message -->
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <!-- Room Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($rooms as $room)
        <div class="room-card bg-white rounded-xl shadow-lg overflow-hidden neumorphic-light">
            <!-- Room Image -->
            <div class="h-48 w-full overflow-hidden rounded-t-lg">
                <img class="h-full w-full object-cover" 
                     src="{{ $room->foto ? Storage::url($room->foto) : 'https://via.placeholder.com/400x200?text=No+Image' }}" 
                     alt="Foto {{ $room->nama_ruangan }}">
            </div>
            
            <!-- Room Details -->
            <div class="p-5">
                <h3 class="font-bold text-xl mb-1 text-gray-800">{{ $room->nama_ruangan }}</h3>
                <p class="text-gray-600 text-sm mb-3">{{ $room->gedung }}</p>
                
                <!-- Status Badge -->
                @php
                    $statusClass = 'status-available';
                    if($room->status === 'Sedang Digunakan') $statusClass = 'status-occupied';
                    elseif($room->status === 'Dalam Perbaikan') $statusClass = 'status-maintenance';
                @endphp
                <div class="flex justify-between items-center mb-4">
                    <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                        {{ $room->status }}
                    </span>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-between items-center">
                    <div class="flex space-x-4">
                        <form action="{{ route('admin.rooms.override', $room) }}" method="POST" class="form-override">
                            @csrf
                            <button type="submit" class="action-button override" title="Override">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </button>
                        </form>
                        
                        <a href="{{ route('admin.rooms.show', $room) }}" class="action-button view" title="Lihat">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        
                        <a href="{{ route('admin.rooms.edit', $room) }}" class="action-button edit" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"></path>
                            </svg>
                        </a>
                        
                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button delete" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full neumorphic-light p-8 rounded-xl text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada ruangan yang cocok dengan filter Anda</h3>
            <p class="mt-1 text-gray-500">Coba ubah kriteria pencarian atau tambahkan ruangan baru</p>
            <div class="mt-6">
                <a href="{{ route('admin.rooms.create') }}" class="glass-button inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    Tambah Ruangan
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <script>
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

        // Konfirmasi untuk tombol hapus
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    background: '#e0e5ec'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Konfirmasi untuk tombol override
        document.querySelectorAll('.form-override').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Buka Paksa Ruangan?',
                    text: "Aksi ini akan tercatat di log sistem.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#8B5CF6',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, Buka Paksa!',
                    cancelButtonText: 'Batal',
                    background: '#e0e5ec'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>