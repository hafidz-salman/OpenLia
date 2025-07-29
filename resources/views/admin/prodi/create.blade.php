<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Prodi Baru</title>
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
        
        .cancel-button {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .cancel-button:hover {
            background: rgba(156, 163, 175, 0.8);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .input-field {
            background: #e0e5ec;
            box-shadow: inset 2px 2px 5px #a3b1c6, inset -2px -2px 5px #ffffff;
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            box-shadow: inset 3px 3px 6px #a3b1c6, inset -3px -3px 6px #ffffff;
            outline: 1px solid #3b82f6;
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <!-- Content Header -->
    <div class="flex flex-col md:flex-row justify-between items-start mb-6 md:mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Prodi Baru</h1>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.prodi.index') }}" class="flex items-center cancel-button text-gray-700 font-semibold py-2 px-4 rounded-lg shadow-sm transition w-full md:w-auto justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Panel -->
    <div class="neumorphic-light rounded-xl p-4 md:p-8 max-w-3xl mx-auto">
        <form action="{{ route('admin.prodi.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nama_prodi" class="block text-gray-700 font-medium mb-2">Nama Prodi</label>
                <input type="text" name="nama_prodi" id="nama_prodi" 
                       class="input-field w-full p-3 rounded-lg focus:outline-none" 
                       required>
            </div>
            
            <div class="mb-8">
                <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" 
                          class="input-field w-full p-3 rounded-lg focus:outline-none">{{ old('deskripsi', $prodi->deskripsi ?? '') }}</textarea>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-end gap-4">
                <button type="submit" class="glass-button text-white bg-blue-600 hover:bg-blue-700 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Simpan
                </button>
                <a href="{{ route('admin.prodi.index') }}" class="cancel-button text-gray-700 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>