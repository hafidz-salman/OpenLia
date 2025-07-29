<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impor Data Ruangan</title>
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
        
        .file-drop-area {
            border: 2px dashed rgba(59, 130, 246, 0.3);
            border-radius: 0.5rem;
            transition: all 0.3s;
        }
        
        .file-drop-area.active {
            border-color: rgba(59, 130, 246, 0.8);
            background-color: rgba(59, 130, 246, 0.05);
        }
        
        .instruction-box {
            background: rgba(191, 219, 254, 0.3);
            border-left: 4px solid #3b82f6;
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <!-- Content Header -->
    <div class="flex flex-col md:flex-row justify-between items-start mb-6 md:mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Impor Data Ruangan</h1>
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Impor</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Import Panel -->
    <div class="neumorphic-light rounded-xl p-6 md:p-8 max-w-2xl mx-auto">
        <!-- Instruction Box -->
        <div class="instruction-box p-4 rounded-lg mb-8">
            <h2 class="text-lg font-bold text-blue-800 mb-2">Instruksi Impor</h2>
            <ul class="list-disc list-inside text-blue-700 space-y-1">
                <li>Gunakan template yang kami sediakan untuk memastikan format data benar</li>
                <li>Kolom <span class="font-mono bg-blue-100 px-1 rounded">status</span> bersifat opsional</li>
                <li>Jika status dikosongkan, akan otomatis menjadi "Tersedia"</li>
                <li>File harus dalam format .xlsx (Excel)</li>
            </ul>
        </div>

        <!-- Download Template Button -->
        <div class="flex justify-center mb-8">
            <a href="/template-ruangan.xlsx" download 
               class="glass-button inline-flex items-center justify-center text-white bg-green-600 hover:bg-green-700 font-semibold py-3 px-6 rounded-lg shadow-md transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download Template Excel
            </a>
        </div>

        <hr class="my-6 border-gray-300">

        <!-- Upload Form -->
        <form action="{{ route('admin.rooms.import.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="file-drop-area" class="file-drop-area p-8 text-center mb-6">
                <input type="file" name="excel_file" id="excel_file" 
                       class="absolute opacity-0 w-full h-full top-0 left-0 cursor-pointer" required>
                <div class="flex flex-col items-center justify-center">
                    <svg class="w-12 h-12 text-blue-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-700 mb-1">Seret file Excel ke sini</h3>
                    <p class="text-gray-500 text-sm mb-3">atau</p>
                    <div class="glass-button text-blue-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Pilih File
                    </div>
                    <p id="file-name" class="text-sm text-gray-500 mt-3"></p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-6">
                <button type="submit" class="glass-button text-white bg-blue-600 hover:bg-blue-700 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Impor Sekarang
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="cancel-button text-gray-700 font-semibold py-3 px-6 rounded-lg shadow-md transition w-full sm:w-auto text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        // Drag and drop functionality
        const fileDropArea = document.getElementById('file-drop-area');
        const fileInput = document.getElementById('excel_file');
        const fileNameDisplay = document.getElementById('file-name');

        // Highlight drop area when file is dragged over
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileDropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileDropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileDropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            fileDropArea.classList.add('active');
        }

        function unhighlight() {
            fileDropArea.classList.remove('active');
        }

        // Handle dropped files
        fileDropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            updateFileNameDisplay();
        }

        // Handle selected files
        fileInput.addEventListener('change', updateFileNameDisplay);

        function updateFileNameDisplay() {
            if (fileInput.files.length) {
                fileNameDisplay.textContent = `File dipilih: ${fileInput.files[0].name}`;
            } else {
                fileNameDisplay.textContent = '';
            }
        }
    </script>
</body>
</html>