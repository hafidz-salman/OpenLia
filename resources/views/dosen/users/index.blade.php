<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna Prodi</title>
    <style>
        :root {
            --primary-color: #5a67d8;
            --secondary-color: #f8fafc;
            --text-color: #2d3748;
            --light-gray: #f0f0f0;
            --lighter-gray: #fafafa;
            --hover-gray: #f5f5f5;
            --shadow-color: #d1d5db;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--text-color);
            padding: 20px;
            min-height: 100vh;
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Neumorphic Panel Styles */
        .neumorphic-panel {
            background: var(--light-gray);
            border-radius: 12px;
            padding: 25px;
            box-shadow:  8px 8px 16px var(--shadow-color),
                        -8px -8px 16px #ffffff;
            margin-bottom: 30px;
        }

        /* Header Section */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .header-text h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            color: var(--text-color);
            opacity: 0.8;
            font-size: 14px;
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
            margin-right: 5px;
        }

        .breadcrumb-separator {
            margin: 0 5px;
            color: var(--text-color);
            opacity: 0.5;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .back-button:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(90, 103, 216, 0.2);
        }

        .back-button i {
            margin-right: 8px;
        }

        /* Table Styles */
        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            background-color: var(--secondary-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        thead {
            background-color: var(--lighter-gray);
        }

        th {
            padding: 16px 12px;
            text-align: left;
            color: var(--text-color);
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.3px;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* Role Badges */
        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 13px;
            text-transform: capitalize;
        }

        .role-dosen {
            background-color: rgba(90, 103, 216, 0.1);
            color: var(--primary-color);
            border: 1px solid rgba(90, 103, 216, 0.3);
        }

        .role-mahasiswa {
            background-color: rgba(72, 187, 120, 0.1);
            color: #48bb78;
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        .role-admin {
            background-color: rgba(245, 101, 101, 0.1);
            color: #f56565;
            border: 1px solid rgba(245, 101, 101, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #718096;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            color: #cbd5e0;
        }

        .empty-state p {
            font-size: 16px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
            }

            .header-text {
                margin-bottom: 20px;
            }

            .back-button {
                width: 100%;
                justify-content: center;
            }

            .neumorphic-panel {
                padding: 20px;
            }

            th, td {
                padding: 12px 8px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .neumorphic-panel {
                padding: 15px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .breadcrumb {
                font-size: 13px;
            }

            .role-badge {
                padding: 4px 8px;
                font-size: 12px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="content-container">
        <!-- Header Section -->
        <div class="neumorphic-panel">
            <div class="header-container">
                <div class="header-text">
                    <h1>Daftar Pengguna Prodi: {{ Auth::user()->prodi->nama_prodi ?? '' }}</h1>
                    <div class="breadcrumb">
                        <a href="{{ route('dosen.dashboard') }}">Dashboard</a>
                        <span class="breadcrumb-separator">/</span>
                        <span>Daftar Pengguna</span>
                    </div>
                </div>
                <a href="{{ route('dosen.dashboard') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="neumorphic-panel">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Tahun Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="role-badge role-{{ $user->role }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->tahun_masuk ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-users-slash"></i>
                                        <p>Tidak ada pengguna lain di prodi Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>