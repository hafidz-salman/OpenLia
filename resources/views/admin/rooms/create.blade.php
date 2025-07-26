<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ruangan Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Tambah Ruangan Baru</h1>
        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_ruangan" class="block text-gray-700 font-semibold">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="w-full p-2 border rounded mt-1" required>
                </div>
                <div>
                    <label for="gedung" class="block text-gray-700 font-semibold">Gedung</label>
                    <input type="text" name="gedung" class="w-full p-2 border rounded mt-1" required>
                </div>
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-gray-700 font-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full p-2 border rounded mt-1"></textarea>
                </div>
                <div>
                    <label for="status" class="block text-gray-700 font-semibold">Status</label>
                    <input type="text" name="status" class="w-full p-2 border rounded mt-1" value="Tersedia" required>
                </div>
                <div>
                    <label for="foto" class="block text-gray-700 font-semibold">Foto Ruangan</label>
                    <input type="file" name="foto" class="w-full p-1.5 border rounded mt-1">
                </div>
            </div>
            
            <hr class="my-8">

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Fasilitas</label>
                <div class="mb-4">
                    <label for="template" class="mr-2">Gunakan Template:</label>
                    <select id="template" class="p-2 border rounded">
                        <option value="">Pilih Template</option>
                        @foreach ($facilityTemplates as $name => $facilities)
                            <option value="{{ json_encode($facilities) }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="fasilitas-container" class="space-y-2">
                    {{-- Checkbox fasilitas akan ditambahkan oleh JavaScript --}}
                </div>
            </div>

            <div class="flex items-center space-x-4 mt-8">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                <a href="{{ route('admin.rooms.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">Batal</a>
            </div>
        </form>
    </div>

        <hr class="my-10 border-t-2">
        <h2 class="text-2xl font-bold mb-4">Atau Impor dari Excel</h2>
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
            <p>Gunakan template yang disediakan untuk impor massal. Kolom status bersifat opsional.</p>
        </div>
        <a href="/template-ruangan.xlsx" download class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-6">
            Download Template
        </a>
        <form action="{{ route('admin.rooms.import.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="excel_file" class="block text-gray-700 font-semibold">Pilih File Excel (.xlsx):</label>
                <input type="file" name="excel_file" id="excel_file" class="w-full p-2 border rounded mt-2" required>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Impor Sekarang</button>
        </form>

    <script>
        document.getElementById('template').addEventListener('change', function() {
            const container = document.getElementById('fasilitas-container');
            container.innerHTML = ''; // Kosongkan container
            if (this.value) {
                const facilities = JSON.parse(this.value);
                facilities.forEach(facility => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="fasilitas[]" value="${facility}" class="form-checkbox" checked>
                            <span class="ml-2">${facility}</span>
                        </label>
                    `;
                    container.appendChild(div);
                });
            }
        });
    </script>
</body>
</html>