<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Neumorphic Effect */
        .neumorphic {
            border-radius: 1rem;
            background: #f0f0f0;
            box-shadow:  10px 10px 20px #d9d9d9,
                        -10px -10px 20px #ffffff;
            transition: all 0.3s ease;
        }
        
        .neumorphic:hover {
            box-shadow:  5px 5px 10px #d9d9d9,
                        -5px -5px 10px #ffffff;
        }
        
        /* Liquid Glass Button */
        .liquid-glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            color: white;
            transition: all 0.3s ease;
        }
        
        .liquid-glass:hover {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
        }
        
        /* Bento Grid Layout */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: minmax(100px, auto);
            gap: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .panel-photo {
            grid-column: span 2;
            grid-row: span 2;
        }
        
        .panel-qr {
            grid-column: span 1;
            grid-row: span 2;
        }
        
        .panel-details {
            grid-column: span 2;
            grid-row: span 1;
        }
        
        .panel-description {
            grid-column: span 3;
            grid-row: span 1;
        }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-8 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        Admin
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('admin.rooms.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Manajemen Ruangan</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Ruangan: {{ $room->nama_ruangan }}</h1>
        </div>
        
        <!-- Bento Grid -->
        <div class="bento-grid mb-8">
            <!-- Panel Foto (2x2) -->
            <div class="panel-photo neumorphic p-6 flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="mt-2 text-gray-500">Foto Ruangan</p>
                    <p class="text-xs text-gray-400 mt-2">(Area untuk menampilkan foto ruangan)</p>
                </div>
            </div>
            
            <!-- Panel QR Code (1x2) -->
            <div class="panel-qr neumorphic p-6 flex flex-col items-center justify-center">
                <strong class="block text-gray-700 mb-4 text-lg">QR Code</strong>
                <div id="qr-code-container" class="p-2 bg-white rounded-lg">
                    {!! $qrCode !!}
                </div>
                <p class="text-xs text-gray-500 mt-2 mb-4">Scan untuk akses ruangan</p>
                
                <button id="download-btn" class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-full w-full max-w-xs">
                    Download QR
                </button>
            </div>
            
            <!-- Panel Detail Utama (2x1) -->
            <div class="panel-details neumorphic p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Informasi Utama</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <strong class="block text-gray-600 text-sm">Kode Unik:</strong>
                        <p class="text-lg font-mono bg-gray-100 p-2 rounded mt-1">{{ $room->code }}</p>
                    </div>
                    <div>
                        <strong class="block text-gray-600 text-sm">Gedung:</strong>
                        <p class="text-lg mt-1">{{ $room->gedung }}</p>
                    </div>
                    <div>
                        <strong class="block text-gray-600 text-sm">Status:</strong>
                        <p class="text-lg mt-1">
                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                {{ $room->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $room->status }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <strong class="block text-gray-600 text-sm">Kapasitas:</strong>
                        <p class="text-lg mt-1">{{ $room->kapasitas ?? '-' }} orang</p>
                    </div>
                </div>
            </div>
            
            <!-- Panel Deskripsi & Fasilitas (3x1) -->
            <div class="panel-description neumorphic p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Deskripsi & Fasilitas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <strong class="block text-gray-600 text-sm mb-2">Deskripsi:</strong>
                        <p class="text-gray-700">{{ $room->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                    <div>
                        <strong class="block text-gray-600 text-sm mb-2">Fasilitas:</strong>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            @if(isset($room->fasilitas) && is_array($room->fasilitas))
                                @foreach($room->fasilitas as $fasilitas)
                                    <li>{{ $fasilitas }}</li>
                                @endforeach
                            @else
                                <li>Tidak ada fasilitas tercatat</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tombol Kembali -->
        <div class="text-center">
            <a href="{{ route('admin.rooms.index') }}" class="liquid-glass inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-8 rounded-full">
                Kembali ke Daftar Ruangan
            </a>
        </div>
    </div>

    {{-- Skrip JavaScript untuk Fungsi Download --}}
    <script>
        document.getElementById('download-btn').addEventListener('click', function() {
            const svgElement = document.querySelector('#qr-code-container svg');
            const svgData = new XMLSerializer().serializeToString(svgElement);
            const blob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            
            const a = document.createElement('a');
            a.href = url;

            const roomName = '{{ $room->nama_ruangan }}';
            const roomCode = '{{ $room->code }}';
            const cleanRoomName = roomName.replace(/\s+/g, '-');
            a.download = `QR-${cleanRoomName}-${roomCode}.svg`; 
            
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        });
    </script>
</body>
</html>