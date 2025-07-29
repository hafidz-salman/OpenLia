<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Prodi</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        
        .detail-item {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <!-- Content Header -->
    <div class="flex flex-col md:flex-row justify-between items-start mb-6 md:mb-8 gap-4">
        <div class="w-full">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Prodi: {{ $prodi->nama_prodi }}</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center flex-wrap gap-y-1 space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Admin
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.prodi.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Manajemen Prodi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Detail Panel -->
    <div class="neumorphic-light rounded-xl p-4 md:p-8 max-w-3xl mx-auto">
        <div class="space-y-6">
            <div class="detail-item">
                <strong class="block text-gray-700 font-medium mb-1">ID:</strong>
                <p class="text-gray-800">{{ $prodi->id }}</p>
            </div>

            <div class="detail-item">
                <strong class="block text-gray-700 font-medium mb-1">Nama Prodi:</strong>
                <p class="text-gray-800">{{ $prodi->nama_prodi }}</p>
            </div>

            <div class="detail-item">
                <strong class="block text-gray-700 font-medium mb-1">Deskripsi:</strong>
                <p class="text-gray-800 whitespace-pre-line">{{ $prodi->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            </div>

            <div class="detail-item">
                <strong class="block text-gray-700 font-medium mb-1">Dibuat Pada:</strong>
                <p class="text-gray-800">{{ $prodi->created_at->format('d M Y, H:i') }}</p>
            </div>

            <div class="detail-item">
                <strong class="block text-gray-700 font-medium mb-1">Terakhir Diupdate:</strong>
                <p class="text-gray-800">{{ $prodi->updated_at->format('d M Y, H:i') }}</p>
            </div>

            <div class="pt-4 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('admin.prodi.index') }}" class="glass-button inline-flex items-center justify-center text-blue-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
                <a href="{{ route('admin.prodi.edit', $prodi->id) }}" class="glass-button inline-flex items-center justify-center text-yellow-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Prodi
                </a>
            </div>
        </div>
    </div>

</body>
</html>