<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <style>
        :root {
            --primary-color: #5a67d8;
            --primary-light: #7f8de8;
            --secondary-color: #f8fafc;
            --text-color: #2d3748;
            --light-gray: #f0f0f0;
            --lighter-gray: #fafafa;
            --shadow-color: #d1d5db;
            --indigo-card: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --blue-card: linear-gradient(135deg, #6b73ff 0%, #000dff 100%);
            --green-card: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --purple-card: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
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

        /* Header Section */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .header-text h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .header-text p {
            color: var(--text-color);
            opacity: 0.9;
            font-size: 16px;
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-btn {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 3px 3px 6px var(--shadow-color),
                       -3px -3px 6px #ffffff;
        }

        .dropdown-btn:hover {
            box-shadow: inset 2px 2px 5px var(--shadow-color),
                        inset -2px -2px 5px #ffffff;
        }

        .dropdown-btn i {
            margin-right: 8px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--secondary-color);
            min-width: 160px;
            border-radius: 8px;
            box-shadow: 3px 3px 6px var(--shadow-color),
                       -3px -3px 6px #ffffff;
            z-index: 1;
            overflow: hidden;
        }

        .dropdown-content a {
            color: var(--text-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: var(--hover-gray);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Bento Grid Layout */
        .bento-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (min-width: 768px) {
            .bento-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Card Styles */
        .card {
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 8px 8px 16px var(--shadow-color),
                       -8px -8px 16px #ffffff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 12px 12px 24px var(--shadow-color),
                       -12px -12px 24px #ffffff;
        }

        .card-primary {
            background: var(--indigo-card);
            color: white;
        }

        .card-secondary {
            background-color: var(--secondary-color);
        }

        .card-icon {
            position: absolute;
            font-size: 100px;
            opacity: 0.1;
            right: 20px;
            bottom: 20px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            z-index: 2;
        }

        .card-desc {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 15px;
            z-index: 2;
        }

        .card-link {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .card-secondary .card-link {
            color: var(--primary-color);
        }

        .card-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .card-link i {
            margin-right: 8px;
        }

        /* Full-width cards */
        .card-full {
            grid-column: 1 / -1;
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

            .dropdown {
                width: 100%;
                margin-top: 15px;
            }

            .dropdown-btn {
                width: 100%;
                justify-content: center;
            }

            .card {
                min-height: 160px;
                padding: 20px;
            }

            .card-title {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .header-text h1 {
                font-size: 24px;
            }

            .card-icon {
                font-size: 80px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="content-container">
        <!-- Header Section -->
        <div class="header-container">
            <div class="header-text">
                <h1>Dashboard Mahasiswa</h1>
                <p>Selamat datang, {{ Auth::user()->name }}!</p>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">
                    <i class="fas fa-user-circle"></i> Menu
                </button>
                <div class="dropdown-content">
                    <a href="#"><i class="fas fa-user"></i> Profile</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Log Out
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bento Grid Section -->
        <div class="bento-grid">
            <!-- Jadwal Kuliah Card (Full Width) -->
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="card card-primary card-full">
                <div>
                    <h3 class="card-title">Jadwal Kuliah Saya</h3>
                    <p class="card-desc">Lihat jadwal perkuliahan Anda untuk semester ini</p>
                </div>
                <span class="card-icon">🎓</span>
                <span class="card-link">
                    <i class="fas fa-arrow-right"></i> Lihat Jadwal
                </span>
            </a>

            <!-- Scan Ruangan Card -->
            <a href="{{ route('scanner.show') }}" class="card card-secondary">
                <div>
                    <h3 class="card-title">Scan Ruangan</h3>
                    <p class="card-desc">Gunakan kamera untuk akses cepat ke ruangan</p>
                </div>
                <span class="card-icon">📷</span>
                <span class="card-link">
                    <i class="fas fa-qrcode"></i> Scan Sekarang
                </span>
            </a>

            <!-- Booking Ruangan Card -->
            <a href="{{ route('booking.create') }}" class="card card-secondary">
                <div>
                    <h3 class="card-title">Booking Ruangan</h3>
                    <p class="card-desc">Ajukan peminjaman untuk acara atau kegiatan khusus</p>
                </div>
                <span class="card-icon">📅</span>
                <span class="card-link">
                    <i class="fas fa-calendar-plus"></i> Buat Booking
                </span>
            </a>

            <!-- Riwayat Permintaan Card (Full Width) -->
            <a href="{{ route('mahasiswa.history.index') }}" class="card card-primary card-full">
                <div>
                    <h3 class="card-title">Riwayat Permintaan Saya</h3>
                    <p class="card-desc">Lacak status semua permintaan peminjaman ruangan yang Anda ajukan</p>
                </div>
                <span class="card-icon">📋</span>
                <span class="card-link">
                    <i class="fas fa-history"></i> Lihat Riwayat
                </span>
            </a>
        </div>
    </div>

    <script>
        // Simple script to handle dropdown on mobile
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const dropdown = this.nextElementSibling;
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>
</html>