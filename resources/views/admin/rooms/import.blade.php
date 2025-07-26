<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Impor Data Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Impor Data Ruangan dari Excel</h1>

    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
        <p class="font-bold">Instruksi</p>
        <p>1. Gunakan template yang kami sediakan untuk memastikan format data benar.</p>
        <p>2. Kolom `status` bersifat opsional. Jika dikosongkan, status akan otomatis menjadi "Tersedia".</p>
    </div>

    {{-- Link Download Template --}}
    <a href="/template-ruangan.xlsx" download class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-6">
        Download Template Excel
    </a>

    <hr class="my-6">

    <form action="{{ route('admin.rooms.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="excel_file" class="block text-gray-700 font-semibold">Pilih File Excel (.xlsx):</label>
            <input type="file" name="excel_file" id="excel_file" class="w-full p-2 border rounded mt-2" required>
        </div>
        <div class="flex items-center space-x-4 mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Impor Sekarang</button>
            <a href="{{ route('admin.rooms.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">Batal</a>
        </div>
    </form>
</div>
</body>
</html>