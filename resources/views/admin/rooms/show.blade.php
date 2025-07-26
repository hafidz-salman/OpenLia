<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">

    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Detail Ruangan: {{ $room->nama_ruangan }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Bagian Detail Teks --}}
            <div>
                <div class="mb-4">
                    <strong class="block text-gray-700">Kode Unik:</strong>
                    <p class="text-lg font-mono bg-gray-100 p-2 rounded">{{ $room->code }}</p>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700">Gedung:</strong>
                    <p>{{ $room->gedung }}</p>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700">Status:</strong>
                    <p>{{ $room->status }}</p>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700">Deskripsi:</strong>
                    <p>{{ $room->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            {{-- Bagian QR Code --}}
            <div class="text-center">
                <strong class="block text-gray-700 mb-2">QR Code</strong>
                <div id="qr-code-container" class="p-4 border rounded inline-block bg-white">
                    {!! $qrCode !!}
                </div>
                <p class="text-xs text-gray-500 mt-2">Scan untuk akses ruangan</p>
                
                {{-- Tombol Download Baru --}}
                <button id="download-btn" class="mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
                    Download QR
                </button>
            </div>
        </div>

        <a href="{{ route('admin.rooms.index') }}" class="text-blue-500 mt-6 inline-block">Kembali ke Daftar Ruangan</a>
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

            // --- PERUBAHAN DI SINI ---
            // Mengambil nama dan kode ruangan dari Blade
            const roomName = '{{ $room->nama_ruangan }}';
            const roomCode = '{{ $room->code }}';
            
            // Membersihkan nama ruangan agar aman untuk nama file (mengganti spasi dengan '-')
            const cleanRoomName = roomName.replace(/\s+/g, '-');

            // Menggabungkan nama ruangan dan kode unik untuk nama file
            a.download = `QR-${cleanRoomName}-${roomCode}.svg`; 
            
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        });
    </script>

</body>
</html>
