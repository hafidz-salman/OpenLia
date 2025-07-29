<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan Baru</title>
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
        
        .toggle-checkbox:checked {
            @apply right-0 border-green-400;
            right: 0;
            border-color: #68D391;
        }
        .toggle-checkbox:checked + .toggle-label {
            @apply bg-green-400;
            background-color: #68D391;
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <!-- Content Header -->
    <div class="flex flex-col md:flex-row justify-between items-start mb-6 md:mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Ruangan Baru</h1>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Panel -->
    <div class="neumorphic-light rounded-xl p-4 md:p-8 max-w-4xl mx-auto mb-8">
        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_ruangan" class="block text-gray-700 font-medium mb-2">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none" 
                           required>
                </div>
                <div>
                    <label for="gedung" class="block text-gray-700 font-medium mb-2">Gedung</label>
                    <input type="text" name="gedung" id="gedung" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none" 
                           required>
                </div>
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" 
                              class="input-field w-full p-3 rounded-lg focus:outline-none"></textarea>
                </div>
                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                    <input type="text" name="status" id="status" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none" 
                           value="Tersedia" required>
                </div>
                <div>
                    <label for="foto" class="block text-gray-700 font-medium mb-2">Foto Ruangan</label>
                    <div class="relative">
                        <input type="file" name="foto" id="foto" 
                               class="input-field w-full p-3 rounded-lg focus:outline-none opacity-0 absolute">
                        <div class="input-field w-full p-3 rounded-lg text-center cursor-pointer">
                            <span class="text-gray-600">Pilih File</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-6 border-gray-300">

            <div>
                <label class="block text-gray-700 font-medium mb-2">Fasilitas</label>
                <div class="mb-4">
                    <label for="template" class="mr-2 text-gray-600">Gunakan Template:</label>
                    <select id="template" class="input-field p-3 rounded-lg focus:outline-none">
                        <option value="">Pilih Template</option>
                        @foreach ($facilityTemplates as $name => $facilities)
                            <option value="{{ json_encode($facilities) }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="fasilitas-container" class="space-y-3">
                    <!-- Checkbox fasilitas akan ditambahkan oleh JavaScript -->
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8">
                <button type="submit" class="glass-button text-white bg-blue-600 hover:bg-blue-700 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Simpan
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="cancel-button text-gray-700 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Import Panel -->
    <div class="neumorphic-light rounded-xl p-4 md:p-8 max-w-4xl mx-auto">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Atau Impor dari Excel</h2>
        
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg" role="alert">
            <p class="text-sm md:text-base">Gunakan template yang disediakan untuk impor massal. Kolom status bersifat opsional.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <a href="/template-ruangan.xlsx" download class="glass-button inline-flex items-center justify-center text-white bg-green-600 hover:bg-green-700 font-semibold py-3 px-6 rounded-lg shadow-md transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download Template
            </a>
        </div>
        
        <form action="{{ route('admin.rooms.import.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="excel_file" class="block text-gray-700 font-medium mb-2">Pilih File Excel (.xlsx):</label>
                <div class="relative">
                    <input type="file" name="excel_file" id="excel_file" 
                           class="input-field w-full p-3 rounded-lg focus:outline-none opacity-0 absolute">
                    <div class="input-field w-full p-3 rounded-lg text-center cursor-pointer">
                        <span class="text-gray-600">Pilih File Excel</span>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="glass-button text-white bg-blue-600 hover:bg-blue-700 font-semibold py-3 px-6 rounded-lg shadow-md transition">
                    Impor Sekarang
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('template').addEventListener('change', function() {
            const container = document.getElementById('fasilitas-container');
            container.innerHTML = ''; // Kosongkan container
            
            if (this.value) {
                const facilities = JSON.parse(this.value);
                facilities.forEach(facility => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center';
                    div.innerHTML = `
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" name="fasilitas[]" value="${facility}" class="toggle-checkbox sr-only" checked>
                                <div class="toggle-label block bg-gray-300 w-14 h-8 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                            </div>
                            <span class="ml-3 text-gray-700">${facility}</span>
                        </label>
                    `;
                    container.appendChild(div);
                });
            }
        });

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