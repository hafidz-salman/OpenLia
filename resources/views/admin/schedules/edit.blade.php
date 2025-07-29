<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal</title>
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
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-8 min-h-screen">
    <div class="max-w-4xl mx-auto">
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Jadwal</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Jadwal</h1>
            <p class="text-gray-600 mt-1">ID: {{ $schedule->id }}</p>
        </div>
        
        <!-- Form Panel -->
        <div class="neumorphic p-6 mb-6">
            <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Section 1: Detail Mata Kuliah -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">
                        <i class="fas fa-book mr-2 text-blue-500"></i>Detail Mata Kuliah
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah*</label>
                            <input type="text" name="mata_kuliah" value="{{ $schedule->mata_kuliah }}" required
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi*</label>
                            <select name="prodi_id" required
                                    class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" {{ $schedule->prodi_id == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Angkatan*</label>
                            <input type="number" name="angkatan" value="{{ $schedule->angkatan }}" required
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Waktu & Tempat -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">
                        <i class="fas fa-clock mr-2 text-blue-500"></i>Waktu & Tempat
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hari*</label>
                            <select name="hari" required
                                    class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                                @foreach($haris as $hari)
                                    <option value="{{ $hari }}" {{ $schedule->hari == $hari ? 'selected' : '' }}>
                                        {{ $hari }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai*</label>
                            <input type="time" name="jam_mulai" value="{{ $schedule->jam_mulai }}" required
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai*</label>
                            <input type="time" name="jam_selesai" value="{{ $schedule->jam_selesai }}" required
                                   class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ruangan*</label>
                            <select name="room_id" required
                                    class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $schedule->room_id == $room->id ? 'selected' : '' }}>
                                        {{ $room->nama_ruangan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Section 3: Pengajar -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">
                        <i class="fas fa-chalkboard-teacher mr-2 text-blue-500"></i>Pengajar
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dosen Pengajar*</label>
                            <select name="user_id" required
                                    class="neumorphic-inset form-input w-full p-3 rounded-md text-gray-700 focus:outline-none">
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ $schedule->user_id == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8">
                    <a href="{{ route('admin.schedules.index') }}" 
                       class="liquid-glass bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-full text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" 
                            class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-full">
                        <i class="fas fa-save mr-2"></i>Update Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>