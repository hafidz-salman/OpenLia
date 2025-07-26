<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Prodi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Detail Prodi</h1>
        
        <div class="mb-4">
            <strong class="block text-gray-700">ID:</strong>
            <p>{{ $prodi->id }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-gray-700">Nama Prodi:</strong>
            <p>{{ $prodi->nama_prodi }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-gray-700">Dibuat Pada:</strong>
            <p>{{ $prodi->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="mb-4">
             <strong class="block text-gray-700">Deskripsi:</strong>
            <p>{{ $prodi->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <a href="{{ route('admin.prodi.index') }}" class="text-blue-500 mt-4 inline-block">Kembali ke Daftar Prodi</a>
    </div>

</body>
</html>