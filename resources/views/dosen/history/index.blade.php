<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Permintaan Saya</title>
    <style>
        :root {
            --primary-color: #5a67d8;
            --secondary-color: #f8fafc;
            --text-color: #2d3748;
            --light-gray: #f0f0f0;
            --lighter-gray: #fafafa;
            --shadow-color: #d1d5db;
            --pending-color: #f6ad55;
            --approved-color: #48bb78;
            --rejected-color: #f56565;
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

        .header-text p {
            color: var(--text-color);
            opacity: 0.8;
            font-size: 16px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 3px 3px 6px var(--shadow-color),
                       -3px -3px 6px #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .back-button:hover {
            box-shadow: inset 2px 2px 5px var(--shadow-color),
                        inset -2px -2px 5px #ffffff;
            color: var(--primary-color);
        }

        .back-button i {
            margin-right: 8px;
        }

        /* Table Section */
        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 10px;
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

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 13px;
            text-transform: capitalize;
        }

        .status-pending {
            background-color: rgba(246, 173, 85, 0.1);
            color: var(--pending-color);
            border: 1px solid rgba(246, 173, 85, 0.3);
        }

        .status-approved {
            background-color: rgba(72, 187, 120, 0.1);
            color: var(--approved-color);
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        .status-rejected {
            background-color: rgba(245, 101, 101, 0.1);
            color: var(--rejected-color);
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

            .section-title {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .neumorphic-panel {
                padding: 15px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .header-text p {
                font-size: 14px;
            }

            .section-title {
                font-size: 18px;
            }

            .status-badge {
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
                    <h1>Riwayat Permintaan Saya</h1>
                    <p>Berikut adalah riwayat semua permintaan yang pernah Anda ajukan</p>
                </div>
                <a href="{{ route('dosen.dashboard') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Room Request History -->
        <div class="neumorphic-panel">
            <h2 class="section-title">Riwayat Peminjaman Ruangan</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Ruangan</th>
                            <th>Keperluan</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roomRequests as $request)
                            <tr>
                                <td>{{ $request->room->nama_ruangan }}</td>
                                <td>{{ $request->keperluan }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->waktu_mulai)->format('d M Y, H:i') }} - {{ \Carbon\Carbon::parse($request->waktu_selesai)->format('H:i') }}</td>
                                <td><span class="status-badge status-{{ $request->status }}">{{ $request->status }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="far fa-calendar-times"></i>
                                        <p>Anda belum pernah mengajukan peminjaman ruangan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Schedule Change History -->
        <div class="neumorphic-panel">
            <h2 class="section-title">Riwayat Perubahan Jadwal</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Jadwal Lama</th>
                            <th>Usulan Jadwal Baru</th>
                            <th>Alasan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($scheduleChangeRequests as $request)
                            <tr>
                                <td>{{ $request->schedule->mata_kuliah }}</td>
                                <td>{{ $request->schedule->hari }}, {{ date('H:i', strtotime($request->schedule->jam_mulai)) }}</td>
                                <td>{{ $request->hari_baru }}, {{ date('H:i', strtotime($request->jam_mulai_baru)) }}</td>
                                <td>{{ $request->alasan }}</td>
                                <td><span class="status-badge status-{{ $request->status }}">{{ $request->status }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="far fa-calendar-times"></i>
                                        <p>Anda belum pernah mengajukan perubahan jadwal.</p>
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