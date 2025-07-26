<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Edit Ruangan: {{ $room->nama_ruangan }}</h1>
        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Bagian Manajemen Foto --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Manajemen Foto</label>
                @if($room->foto)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Foto Saat Ini:</p>
                        <img src="{{ Storage::url($room->foto) }}" alt="Foto {{ $room->nama_ruangan }}" class="mt-2 w-48 h-auto rounded border">
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="hapus_foto" value="1" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-red-700">Hapus foto saat ini</span>
                            </label>
                        </div>
                    </div>
                @endif
                <div>
                    <label for="foto" class="block text-gray-700 text-sm">Ganti atau Tambah Foto Baru (Opsional)</label>
                    <input type="file" name="foto" id="foto" class="w-full p-1.5 border rounded mt-1">
                </div>
            </div>

            <hr class="my-6">

            {{-- Bagian Detail Ruangan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="nama_ruangan" class="block text-gray-700">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="w-full p-2 border rounded mt-1" value="{{ $room->nama_ruangan }}" required>
                </div>
                <div class="mb-4">
                    <label for="code" class="block text-gray-700">Kode Unik</label>
                    <input type="text" name="code" class="w-full p-2 border rounded mt-1" value="{{ $room->code }}" required>
                </div>
                <div class="mb-4">
                    <label for="gedung" class="block text-gray-700">Gedung</label>
                    <input type="text" name="gedung" class="w-full p-2 border rounded mt-1" value="{{ $room->gedung }}" required>
                </div>
                 <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <input type="text" name="status" class="w-full p-2 border rounded mt-1" value="{{ $room->status }}" required>
                </div>
                <div class="md:col-span-2 mb-4">
                    <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full p-2 border rounded mt-1">{{ $room->deskripsi }}</textarea>
                </div>
            </div>
            
            <div class="flex items-center space-x-4 mt-6">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Update</button>
                <a href="{{ route('admin.rooms.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>