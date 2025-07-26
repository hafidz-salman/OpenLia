<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10 px-4">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Ruangan</h1>
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">Dashboard</a>
                <a href="{{ route('admin.rooms.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Tambah Ruangan</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($rooms as $room)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <img class="h-48 w-full object-cover" src="{{ $room->foto ? Storage::url($room->foto) : 'https://via.placeholder.com/400x200?text=No+Image' }}" alt="Foto {{ $room->nama_ruangan }}">
                <div class="p-5">
                    <h3 class="font-bold text-xl mb-2">{{ $room->nama_ruangan }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ $room->gedung }}</p>
                    <div class="flex justify-between items-center">
                        <span class="inline-block bg-green-200 text-green-800 rounded-full px-3 py-1 text-sm font-semibold">{{ $room->status }}</span>
                        <div class="flex items-center space-x-3">
                            
                            {{-- Tombol Override Baru --}}
                            <form action="{{ route('admin.rooms.override', $room) }}" method="POST" class="form-override">
                                @csrf
                                <button type="submit" class="text-purple-600 hover:text-purple-900" title="Buka Paksa">
                                    Override
                                </button>
                            </form>
                            
                            <a href="{{ route('admin.rooms.show', $room) }}" class="text-blue-500 hover:text-blue-700" title="Lihat">Lihat</a>
                            <a href="{{ route('admin.rooms.edit', $room) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">Edit</a>
                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10 bg-white rounded-lg shadow-md">
                <p class="text-gray-500">Belum ada data ruangan.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        // Notifikasi untuk pesan sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        // Konfirmasi untuk tombol hapus
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Anda yakin?', text: "Data yang dihapus tidak dapat dikembalikan!", icon: 'warning',
                    showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal'
                }).then((result) => { if (result.isConfirmed) { form.submit(); } });
            });
        });

        // Skrip baru untuk konfirmasi override
        document.querySelectorAll('.form-override').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Buka Paksa Ruangan?', text: "Aksi ini akan tercatat di log sistem.", icon: 'warning',
                    showCancelButton: true, confirmButtonColor: '#8B5CF6', cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, Buka Paksa!', cancelButtonText: 'Batal'
                }).then((result) => { if (result.isConfirmed) { form.submit(); } });
            });
        });
    </script>
</body>
</html>