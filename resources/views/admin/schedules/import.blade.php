<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impor Jadwal dari Excel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Neumorphic Effect */
        .neumorphic {
            border-radius: 12px;
            background: #f0f0f0;
            box-shadow:  8px 8px 16px #d9d9d9,
                        -8px -8px 16px #ffffff;
            transition: all 0.3s ease;
        }
        
        /* Liquid Glass Effect */
        .liquid-glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 4px 20px 0 rgba(31, 38, 135, 0.15);
            color: white;
            transition: all 0.3s ease;
        }
        
        .liquid-glass:hover {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.25);
        }
        
        /* File Upload Styling */
        .file-upload {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 2px dashed #3b82f6;
            border-radius: 12px;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .file-upload:hover {
            border-color: #2563eb;
            background-color: #f0f7ff;
        }
        
        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        /* Instruction Box */
        .instruction-box {
            border-left: 4px solid #3b82f6;
            background-color: #f8fafc;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-8 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Admin
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('admin.schedules.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Manajemen Jadwal</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Impor Excel</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Impor Jadwal dari Excel</h1>
        </div>
        
        <!-- Import Panel -->
        <div class="neumorphic p-6 mb-6">
            <!-- Instruction Box -->
            <div class="instruction-box rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>Format File Excel
                </h3>
                <p class="text-gray-700 mb-3">Pastikan header file Excel Anda memiliki kolom berikut:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">mata_kuliah</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">dosen_email</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">kode_ruangan</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">nama_prodi</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">angkatan</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">hari</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">jam_mulai</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-mono px-2 py-1 rounded">jam_selesai</span>
                </div>
            </div>
            
            <!-- Download Template Button -->
            <div class="mb-6 text-center">
                <a href="/template-jadwal.xlsx" download 
                   class="liquid-glass bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-full inline-flex items-center">
                    <i class="fas fa-file-excel mr-2"></i>Download Template Excel
                </a>
            </div>
            
            <!-- Upload Form -->
            <form action="{{ route('admin.schedules.import.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- File Upload Area -->
                <div class="file-upload neumorphic relative">
                    <input type="file" name="excel_file" id="excel_file" accept=".xlsx,.xls" class="file-input" required>
                    <div class="text-center">
                        <i class="fas fa-file-upload text-4xl text-blue-500 mb-3"></i>
                        <h4 class="text-lg font-medium text-gray-800">Pilih atau drop file Excel disini</h4>
                        <p class="text-sm text-gray-500 mt-1">Format yang didukung: .xlsx, .xls</p>
                        <p class="text-xs text-gray-400 mt-2">Ukuran maksimal: 5MB</p>
                    </div>
                </div>
                <div id="file-name" class="text-sm text-gray-600 mt-2 text-center"></div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('admin.schedules.index') }}" 
                       class="liquid-glass bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-full text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" 
                            class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-full">
                        <i class="fas fa-upload mr-2"></i>Impor Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Show selected file name
        document.getElementById('excel_file').addEventListener('change', function(e) {
            const fileNameDisplay = document.getElementById('file-name');
            if (this.files.length > 0) {
                fileNameDisplay.textContent = 'File dipilih: ' + this.files[0].name;
                fileNameDisplay.className = 'text-sm text-green-600 mt-2 text-center';
            } else {
                fileNameDisplay.textContent = '';
            }
        });
        
        // Drag and drop functionality
        const fileUpload = document.querySelector('.file-upload');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUpload.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUpload.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileUpload.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            fileUpload.classList.add('border-blue-400', 'bg-blue-50');
        }
        
        function unhighlight() {
            fileUpload.classList.remove('border-blue-400', 'bg-blue-50');
        }
        
        fileUpload.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            const input = document.getElementById('excel_file');
            input.files = files;
            
            // Trigger change event
            const event = new Event('change');
            input.dispatchEvent(event);
        }
    </script>
</body>
</html>