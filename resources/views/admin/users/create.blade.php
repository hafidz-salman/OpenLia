<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
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
        
        .neumorphic-inset {
            border-radius: 8px;
            background: #f0f0f0;
            box-shadow: inset 5px 5px 10px #d9d9d9,
                        inset -5px -5px 10px #ffffff;
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
        
        /* Form Input Styles */
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
        
        /* Error Styles */
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .error-input {
            border: 1px solid #ef4444;
        }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-8 min-h-screen">
    <div class="max-w-2xl mx-auto">
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
                            <a href="{{ route('admin.users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Manajemen Pengguna</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah Baru</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Pengguna Baru</h1>
        </div>
        
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="neumorphic bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span class="font-medium">Mohon perbaiki kesalahan berikut:</span>
                </div>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Form Panel -->
        <div class="neumorphic p-6 mb-6">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <!-- Section 1: Informasi Dasar -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">
                        <i class="fas fa-user-circle mr-2 text-blue-500"></i>Informasi Dasar
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap*</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none @error('name') error-input @enderror">
                            @error('name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none @error('email') error-input @enderror">
                            @error('email')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password*</label>
                            <input type="password" name="password" required
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none @error('password') error-input @enderror">
                            @error('password')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Peran*</label>
                            <select name="role" id="role-select" required
                                    class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none @error('role') error-input @enderror">
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Informasi Akademik (Conditional) -->
                <div id="academic-info-section" class="mb-8 hidden">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">
                        <i class="fas fa-graduation-cap mr-2 text-blue-500"></i>Informasi Akademik
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div id="prodi-field">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                            <select name="prodi_id"
                                    class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none @error('prodi_id') error-input @enderror">
                                <option value="">- Pilih Prodi -</option>
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div id="tahun-masuk-field">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                            <input type="number" name="tahun_masuk" value="{{ old('tahun_masuk') }}"
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none @error('tahun_masuk') error-input @enderror">
                            @error('tahun_masuk')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8">
                    <a href="{{ route('admin.users.index') }}" 
                       class="liquid-glass bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-full text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" 
                            class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-full">
                        <i class="fas fa-save mr-2"></i>Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Conditional fields based on role selection
        const roleSelect = document.getElementById('role-select');
        const academicSection = document.getElementById('academic-info-section');
        const prodiField = document.getElementById('prodi-field');
        const tahunMasukField = document.getElementById('tahun-masuk-field');
        
        function toggleAcademicFields() {
            const selectedRole = roleSelect.value;
            
            if (selectedRole === 'mahasiswa' || selectedRole === 'dosen') {
                academicSection.classList.remove('hidden');
                
                // Show/hide specific fields based on role
                if (selectedRole === 'mahasiswa') {
                    prodiField.style.display = 'block';
                    tahunMasukField.style.display = 'block';
                } else if (selectedRole === 'dosen') {
                    prodiField.style.display = 'block';
                    tahunMasukField.style.display = 'none';
                }
            } else {
                academicSection.classList.add('hidden');
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleAcademicFields();
            
            // Add event listener for role change
            roleSelect.addEventListener('change', toggleAcademicFields);
        });
    </script>
</body>
</html>