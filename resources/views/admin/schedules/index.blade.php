<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Jadwal</title>
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
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Accordion Transition */
        .accordion-content {
            transition: max-height 0.3s ease-out, opacity 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Jadwal</h1>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                Admin
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Manajemen Jadwal</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            
            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                <a href="{{ route('admin.schedules.create') }}" class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-full flex items-center gap-2 w-full md:w-auto justify-center">
                    <i class="fas fa-plus"></i>
                    <span class="hidden sm:inline">Tambah Jadwal</span>
                </a>
                <a href="{{ route('admin.schedules.import.show') }}" class="liquid-glass bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-full flex items-center gap-2 w-full md:w-auto justify-center">
                    <i class="fas fa-file-import"></i>
                    <span class="hidden sm:inline">Impor Excel</span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="liquid-glass bg-green-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-full flex items-center gap-2 w-full md:w-auto justify-center">
                <i class="fas fa-home"></i>
                <span class="hidden sm:inline">Dashboard</span>
                </a>
            </div>
        </div>
        
        @if (session('success'))
        <div class="neumorphic bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif
        
        <!-- Filter Panel -->
        <div class="neumorphic p-4 md:p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Filter Jadwal</h2>
            <form id="filterForm" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="prodi" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                    <select id="prodi" name="prodi" class="neumorphic-inset w-full p-2 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Prodi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-1">Angkatan</label>
                    <select id="angkatan" name="angkatan" class="neumorphic-inset w-full p-2 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Angkatan</option>
                        @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                
                <div>
                    <label for="dosen" class="block text-sm font-medium text-gray-700 mb-1">Dosen</label>
                    <select id="dosen" name="dosen" class="neumorphic-inset w-full p-2 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Dosen</option>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end gap-2">
                    <button type="submit" class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-full flex-1">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <button type="reset" class="liquid-glass bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-full">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Jadwal Content -->
        <div class="neumorphic p-4 md:p-6">
            @if($schedules->isEmpty())
                <div class="text-center py-8">
                    <i class="fas fa-calendar-times text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Belum ada data jadwal.</p>
                    <a href="{{ route('admin.schedules.create') }}" class="liquid-glass bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-full inline-block mt-4">
                        Tambah Jadwal Pertama
                    </a>
                </div>
            @else
                <!-- Group by Hari -->
                @php
                    $groupedSchedules = $schedules->groupBy('hari');
                    $daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                @endphp
                
                @foreach($daysOrder as $day)
                    @if($groupedSchedules->has($day))
                        <div class="mb-6">
                            <button class="accordion-toggle w-full flex justify-between items-center p-3 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors" 
                                    onclick="toggleAccordion('{{ $day }}')">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $day }}</h3>
                                <i class="fas fa-chevron-down transition-transform" id="icon-{{ $day }}"></i>
                            </button>
                            
                            <div class="accordion-content overflow-hidden max-h-0" id="content-{{ $day }}">
                                <div class="overflow-x-auto py-4">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prodi & Angkatan</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($groupedSchedules->get($day) as $schedule)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    {{ date('H:i', strtotime($schedule->jam_mulai)) }} - {{ date('H:i', strtotime($schedule->jam_selesai)) }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    {{ $schedule->mata_kuliah }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    {{ $schedule->user->name ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    {{ $schedule->room->nama_ruangan ?? 'N/A' }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    {{ $schedule->prodi->nama_prodi ?? 'N/A' }} ({{ $schedule->angkatan }})
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    <div class="flex items-center gap-2">
                                                        <a href="{{ route('admin.schedules.edit', $schedule) }}" 
                                                           class="liquid-glass bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full flex items-center justify-center"
                                                           title="Edit">
                                                            <i class="fas fa-edit text-xs"></i>
                                                        </a>
                                                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" 
                                                                    class="liquid-glass bg-red-500 hover:bg-red-600 text-white p-2 rounded-full flex items-center justify-center"
                                                                    title="Hapus">
                                                                <i class="fas fa-trash-alt text-xs"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    <script>
        // Accordion functionality
        function toggleAccordion(day) {
            const content = document.getElementById(`content-${day}`);
            const icon = document.getElementById(`icon-${day}`);
            
            if (content.classList.contains('max-h-0')) {
                content.classList.remove('max-h-0');
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.classList.add('rotate-180');
            } else {
                content.style.maxHeight = '0';
                icon.classList.remove('rotate-180');
            }
        }
        
        // Initialize first accordion as open
        document.addEventListener('DOMContentLoaded', function() {
            const firstDay = document.querySelector('.accordion-toggle');
            if (firstDay) {
                const firstDayId = firstDay.getAttribute('onclick').match(/'([^']+)'/)[1];
                toggleAccordion(firstDayId);
            }
        });
        
        // Filter form submission
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Implement your filter logic here
            console.log('Filtering...');
        });
    </script>
</body>
</html>