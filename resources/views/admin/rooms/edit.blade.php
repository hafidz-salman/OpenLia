<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan</title>
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
        
        .update-button {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .update-button:hover {
            background: rgba(234, 179, 8, 0.8);
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
        
        .toggle-checkbox:checked {
            @apply right-0 border-green-400;
            right: 0;
            border-color: #68D391;
        }
        .toggle-checkbox:checked + .toggle-label {
            @apply bg-green-400;
            background-color: #68D391;
        }
        
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        
        .file-input-button {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            color: #4b5563;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-input-button:hover {
            background: rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <!-- Content Header -->
    <div class="flex flex-col md:flex-row justify-between items-start mb-6 md:mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Ruangan: {{ $room->nama_ruangan }}</h1>
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
                            <a href="{{ route('admin.rooms.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Manajemen Ruangan</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Panel -->
    <div class="neumorphic-light rounded-xl p-4 md:p-8 max-w-4xl mx-auto">
        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Bagian Manajemen Foto -->
            <div class="mb-8">
                <label class="block text-gray-700 font-medium mb-4">Manajemen Foto</label>
                
                @if($room->foto)
                    <div class="mb-6 p-4 rounded-lg bg-gray-50 shadow-inner">
                        <p class="text-sm text-gray-600 mb-2">Foto Saat Ini:</p>
                        <div class="flex flex-col md:flex-row items-start gap-6">
                            <img src="{{ Storage::url($room->foto) }}" alt="Foto {{ $room->nama_ruangan }}" 
                                 class="w-full md:w-48 h-auto rounded-lg shadow-md border border-gray-200">
                            <div class="flex-grow">
                                <div class="mb-4">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="hapus_foto" value="1" 
                                               class="form-checkbox h-5 w-5 text-red-600 rounded focus:ring-red-500">
                                        <span class="ml-2 text-red-700 font-medium">Hapus foto saat ini</span>
                                    </label>
                                </div>
                                <div class="file-input-wrapper">
                                    <label for="foto" class="block text-gray-700 text-sm font-medium mb-2">Ganti atau Tambah Foto Baru (Opsional)</label>
                                    <input type="file" name="foto" id="foto" 
                                           class="input-field w-full p-3 rounded-lg focus:outline-none opacity-0 absolute">
                                    <div class="input-field w-full p-3 rounded-lg text-center cursor-pointer">
                                        <span class="text-gray-600">Pilih File Baru</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="file-input-wrapper">
                        <label for="foto" class="block text-gray-700 text-sm font-medium mb-2">Tambah Foto (Opsional)</label>
                        <input type="file" name="foto" id="foto" 
                               class="input-field w-full p-3 rounded-lg focus:outline-none opacity-0 absolute">
                        <div class="input-field w-full p-3 rounded-lg text-center cursor-pointer">
                            <span class="text-gray-600">Pilih File</span>
                        </div>
                    </div>
                @endif
            </div>

            <hr class="my-6 border-gray-300">

            <!-- Bagian Detail Ruangan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_ruangan" class="block text-gray-700 font-medium mb-2">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none" 
                           value="{{ $room->nama_ruangan }}" required>
                </div>
                <div>
                    <label for="code" class="block text-gray-700 font-medium mb-2">Kode Unik</label>
                    <input type="text" name="code" id="code" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none" 
                           value="{{ $room->code }}" required>
                </div>
                <div>
                    <label for="gedung" class="block text-gray-700 font-medium mb-2">Gedung</label>
                    <input type="text" name="gedung" id="gedung" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none" 
                           value="{{ $room->gedung }}" required>
                </div>
                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                    <input type="text" name="status" id="status" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none" 
                           value="{{ $room->status }}" required>
                </div>
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                              class="input-field w-full p-3 rounded-lg focus:outline-none">{{ $room->deskripsi }}</textarea>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8">
                <button type="submit" class="update-button text-white bg-yellow-500 hover:bg-yellow-600 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Update
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="cancel-button text-gray-700 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        // Style file inputs
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name || 'Tidak ada file dipilih';
                this.nextElementSibling.querySelector('span').textContent = fileName;
            });
        });
    </script>
</body>
</html>