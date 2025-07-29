<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Prodi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        }
                    },
                    boxShadow: {
                        'neumorphic-sm': '3px 3px 6px #a3b1c6, -3px -3px 6px #ffffff',
                        'neumorphic-md': '8px 8px 16px #a3b1c6, -8px -8px 16px #ffffff',
                        'neumorphic-lg': '12px 12px 24px #a3b1c6, -12px -12px 24px #ffffff',
                        'neumorphic-inset': 'inset 3px 3px 6px #a3b1c6, inset -3px -3px 6px #ffffff'
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
        
        .action-button {
            transition: all 0.2s ease;
        }
        
        .action-button:hover {
            transform: scale(1.1);
        }
        
        .table-header {
            background: #f0f2f5;
        }

        @media (max-width: 768px) {
            .responsive-table-header {
                display: none;
            }
            .responsive-table-row {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                box-shadow: 3px 3px 6px #a3b1c6, -3px -3px 6px #ffffff;
            }
            .responsive-table-cell {
                display: block;
                width: 100%;
                padding: 0.75rem;
                text-align: left;
                border-bottom: 1px solid #e5e7eb;
            }
            .responsive-table-cell:before {
                content: attr(data-label);
                font-weight: 600;
                display: inline-block;
                width: 120px;
                color: #6b7280;
            }
            .responsive-table-cell:last-child {
                border-bottom: none;
            }
            .action-buttons {
                justify-content: flex-start !important;
                padding-left: 120px;
            }
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-6">

    <!-- Main Content Area -->
    <div class="flex-1">
        <!-- Content Header -->
        <div class="flex flex-col md:flex-row justify-between items-start mb-6 md:mb-8 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Prodi</h1>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Manajemen Prodi</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center glass-button text-gray-700 font-semibold py-1 md:py-2 px-3 md:px-4 rounded-lg shadow-sm transition text-sm md:text-base">
                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.prodi.create') }}" class="flex items-center glass-button text-white bg-blue-600 hover:bg-blue-700 font-semibold py-1 md:py-2 px-3 md:px-4 rounded-lg shadow-md transition text-sm md:text-base">
                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Prodi
                </a>
            </div>
        </div>

        <!-- Table Panel -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden neumorphic-light">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead class="table-header responsive-table-header">
                        <tr>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Prodi</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prodis as $prodi)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 responsive-table-row">
                            <td data-label="ID" class="px-4 md:px-6 py-3 border-b border-gray-200 bg-white text-sm responsive-table-cell">{{ $prodi->id }}</td>
                            <td data-label="Nama Prodi" class="px-4 md:px-6 py-3 border-b border-gray-200 bg-white text-sm font-medium text-gray-800 responsive-table-cell">{{ $prodi->nama_prodi }}</td>
                            <td data-label="Deskripsi" class="px-4 md:px-6 py-3 border-b border-gray-200 bg-white text-sm text-gray-600 responsive-table-cell">{{ Str::limit($prodi->deskripsi, 50, '...') }}</td>
                            <td class="px-4 md:px-6 py-3 border-b border-gray-200 bg-white text-sm responsive-table-cell">
                                <div class="flex items-center space-x-2 md:space-x-4 action-buttons">
                                    <a href="{{ route('admin.prodi.show', $prodi) }}" class="action-button p-1 md:p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100" title="Lihat">
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.prodi.edit', $prodi) }}" class="action-button p-1 md:p-2 rounded-full bg-yellow-50 text-yellow-600 hover:bg-yellow-100" title="Edit">
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.prodi.destroy', $prodi) }}" method="POST" class="form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-button p-1 md:p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100" title="Hapus">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 md:py-10 text-gray-500">
                                <div class="neumorphic-light p-4 md:p-6 rounded-lg inline-block">
                                    <svg class="w-10 h-10 md:w-12 md:h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="mt-2 text-sm md:text-base">Belum ada data prodi.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SweetAlert Scripts -->
    <script>
        // Notifikasi untuk pesan sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false,
                background: '#e0e5ec',
                backdrop: `
                    rgba(224,229,236,0.8)
                    url("/images/nyan-cat.gif")
                    left top
                    no-repeat
                `
            });
        @endif

        // Konfirmasi untuk tombol hapus
        const deleteForms = document.querySelectorAll('.form-hapus');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    background: '#e0e5ec'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>

</body>
</html>