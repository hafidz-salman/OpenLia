<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Prodi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-4">Edit Prodi</h1>

    <form action="{{ route('admin.prodi.update', $prodi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nama_prodi" class="block text-gray-700">Nama Prodi</label>
            <input type="text" name="nama_prodi" id="nama_prodi" class="w-full p-2 border rounded" value="{{ $prodi->nama_prodi }}" required>
        </div>
        <div class="mb-4">
             <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full p-2 border rounded">{{ old('deskripsi', $prodi->deskripsi ?? '') }}</textarea>
        </div>
        <div class="flex items-center space-x-4 mt-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">Update</button>
            <a href="{{ route('admin.prodi.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-md">Batal</a>
        </div>
    </form>

</body>
</html>