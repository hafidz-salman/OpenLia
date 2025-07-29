<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Permintaan Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        light: {
                            bg: '#e0e5ec',
                            highlight: '#ffffff',
                            shadow: '#a3b1c6'
                        },
                        table: {
                            header: '#f0f2f5'
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
        
        .approve-button:hover {
            background: rgba(34, 197, 94, 0.8);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .reject-button:hover {
            background: rgba(239, 68, 68, 0.8);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .table-row:hover {
            background-color: rgba(240, 242, 245, 0.5);
        }

        @media (max-width: 768px) {
            .responsive-table-header {
                display: none;
            }
            .responsive-table-cell {
                display: block;
                width: 100%;
                padding: 0.5rem;
                text-align: left;
            }
            .responsive-table-cell:before {
                content: attr(data-label);
                font-weight: 600;
                display: inline-block;
                width: 120px;
                color: #6b7280;
            }
            .responsive-table-row {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                box-shadow: 3px 3px 6px #a3b1c6, -3px -3px 6px #ffffff;
            }
            .responsive-table-row td {
                border: none;
                border-bottom: 1px solid #e5e7eb;
            }
            .responsive-table-row td:last-child {
                border-bottom: none;
            }
            .action-buttons {
                justify-content: flex-start !important;
                padding-left: 120px;
            }
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-8">

    <!-- Content Header -->
    <div class="flex flex-col md:flex-row justify-between items-start mb-6 md:mb-8 gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Permintaan Ruangan</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Admin
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Permintaan Ruangan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex flex-wrap gap-2 w-full md:w-auto">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600"><svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>Dashboard</a>
            <a href="#" class="bg-blue-100 text-blue-800 px-3 py-1 md:px-4 md:py-2 rounded-lg font-medium text-sm md:text-base">Pending</a>
            <a href="#" class="glass-button text-gray-700 px-3 py-1 md:px-4 md:py-2 rounded-lg font-medium text-sm md:text-base">Approved</a>
            <a href="#" class="glass-button text-gray-700 px-3 py-1 md:px-4 md:py-2 rounded-lg font-medium text-sm md:text-base">Rejected</a>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <!-- Table Panel -->
    <div class="neumorphic-light rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-table-header responsive-table-header">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Pemohon</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Ruangan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Keperluan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Waktu Mulai</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Waktu Selesai</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                    <tr class="table-row transition-colors duration-150 responsive-table-row">
                        <td data-label="Pemohon" class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 responsive-table-cell">{{ $request->user->name }}</td>
                        <td data-label="Ruangan" class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 responsive-table-cell">{{ $request->room->nama_ruangan }}</td>
                        <td data-label="Keperluan" class="px-4 py-3 text-sm text-gray-800 responsive-table-cell">{{ $request->keperluan }}</td>
                        <td data-label="Waktu Mulai" class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 responsive-table-cell">{{ \Carbon\Carbon::parse($request->waktu_mulai)->format('d M Y, H:i') }}</td>
                        <td data-label="Waktu Selesai" class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 responsive-table-cell">{{ \Carbon\Carbon::parse($request->waktu_selesai)->format('d M Y, H:i') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm responsive-table-cell">
                            <div class="flex space-x-2 action-buttons">
                                <form action="{{ route('admin.requests.approve', $request) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="glass-button approve-button flex items-center text-green-600 hover:text-white px-2 py-1 md:px-3 md:py-1 rounded-lg transition text-sm">
                                        <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.requests.reject', $request) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="glass-button reject-button flex items-center text-red-600 hover:text-white px-2 py-1 md:px-3 md:py-1 rounded-lg transition text-sm">
                                        <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="neumorphic-light p-4 rounded-lg inline-block">
                                <svg class="w-8 h-8 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="mt-2">Tidak ada permintaan yang pending.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>