<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kuliah</title>
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
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .header-text h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-color);
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
        }

        .back-button i {
            margin-right: 8px;
        }

        /* Table Styles */
        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 10px;
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

            .neumorphic-panel {
                padding: 20px;
            }

            th, td {
                padding: 12px 8px;
                font-size: 14px;
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            .neumorphic-panel {
                padding: 15px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .empty-state i {
                font-size: 36px;
            }

            .empty-state p {
                font-size: 14px;
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
                    <h1>Jadwal Kuliah Anda</h1>
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="back-button">
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
                            <th>Hari & Jam</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalKuliah as $jadwal)
                            <tr>
                                <td>{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                                <td>{{ $jadwal->mata_kuliah }}</td>
                                <td>{{ $jadwal->user->name }}</td>
                                <td>{{ $jadwal->room->nama_ruangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="far fa-calendar-times"></i>
                                        <p>Tidak ada jadwal kuliah untuk prodi dan angkatan Anda saat ini.</p>
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