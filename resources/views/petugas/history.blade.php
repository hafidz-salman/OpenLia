<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Misi Pembersihan</title>
    <style>
        :root {
            --primary-color: #5a67d8;
            --secondary-color: #f8fafc;
            --text-color: #2d3748;
            --light-gray: #f0f0f0;
            --lighter-gray: #fafafa;
            --shadow-color: #d1d5db;
            --success-color: #48bb78;
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
            border-radius: 16px;
            padding: 24px;
            box-shadow:  8px 8px 16px var(--shadow-color),
                        -8px -8px 16px #ffffff;
            margin-bottom: 24px;
        }

        /* Header Section */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .header-text h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 12px;
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

        /* Stats Panel */
        .stats-panel {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            padding: 16px;
            text-align: center;
            border-radius: 12px;
            background: var(--light-gray);
            box-shadow:  5px 5px 10px var(--shadow-color),
                        -5px -5px 10px #ffffff;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-color);
            opacity: 0.8;
        }

        /* Table Styles */
        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
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

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 13px;
        }

        .status-ongoing {
            background-color: rgba(246, 173, 85, 0.1);
            color: #f6ad55;
            border: 1px solid rgba(246, 173, 85, 0.3);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            margin: 0 4px;
            border-radius: 12px;
            background: var(--light-gray);
            box-shadow:  3px 3px 6px var(--shadow-color),
                        -3px -3px 6px #ffffff;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .active {
            background: var(--primary-color);
            color: white;
            box-shadow: inset 3px 3px 6px rgba(0, 0, 0, 0.1);
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
                align-items: flex-start;
            }

            .header-text {
                margin-bottom: 20px;
            }

            .back-button {
                width: 100%;
                justify-content: center;
            }

            .stat-card {
                min-width: 100%;
            }

            th, td {
                padding: 12px 8px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .neumorphic-panel {
                padding: 16px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .stat-value {
                font-size: 20px;
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
                    <h1>Log Misi Pembersihan</h1>
                </div>
                <a href="{{ route('petugas.dashboard') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali ke Papan Misi
                </a>
            </div>
        </div>

        <!-- Stats Panel -->
        <div class="neumorphic-panel stats-panel">
            <div class="stat-card">
                <div class="stat-value">{{ $totalLogs }}</div>
                <div class="stat-label">Total Misi</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $ongoingLogs }}</div>
                <div class="stat-label">Sedang Berlangsung</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $completedLogs }}</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $avgDuration }}</div>
                <div class="stat-label">Rata-rata Durasi</div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="neumorphic-panel">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Ruangan</th>
                            <th>Tanggal Misi</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Durasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->room->nama_ruangan }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->start_time)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->start_time)->format('H:i') }}</td>
                            <td>
                                @if ($log->end_time)
                                    {{ \Carbon\Carbon::parse($log->end_time)->format('H:i') }}
                                @else
                                    <span class="status-badge status-ongoing">Masih Berlangsung</span>
                                @endif
                            </td>
                            <td>
                                @if ($log->end_time)
                                    {{ \Carbon\Carbon::parse($log->start_time)->diffForHumans($log->end_time, true) }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p>Anda belum memiliki riwayat pembersihan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($logs->hasPages())
            <div class="pagination">
                {{ $logs->links() }}
            </div>
            @endif
        </div>
    </div>
</body>
</html>