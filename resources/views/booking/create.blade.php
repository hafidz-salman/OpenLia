<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ruangan untuk Acara</title>
    <style>
        :root {
            --primary-color: #5a67d8;
            --secondary-color: #f8fafc;
            --text-color: #2d3748;
            --light-gray: #f0f0f0;
            --lighter-gray: #fafafa;
            --hover-gray: #f5f5f5;
            --shadow-color: #d1d5db;
            --danger-color: #e53e3e;
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
            max-width: 800px;
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

        /* Form Styles */
        .form-container {
            width: 100%;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--text-color);
        }

        /* Neumorphic Input Styles */
        .form-control {
            width: 100%;
            padding: 14px 16px;
            background: var(--light-gray);
            border: none;
            border-radius: 8px;
            box-shadow: inset 3px 3px 6px var(--shadow-color),
                        inset -3px -3px 6px #ffffff;
            font-size: 16px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            box-shadow: inset 4px 4px 8px var(--shadow-color),
                        inset -4px -4px 8px #ffffff;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%232d3748' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 12px;
        }

        /* Button Styles */
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background: rgba(90, 103, 216, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--primary-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .btn-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(90, 103, 216, 0.2);
        }

        .btn-secondary {
            background: rgba(226, 232, 240, 0.5);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--text-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Date Time Input Group */
        .datetime-group {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 640px) {
            .datetime-group {
                grid-template-columns: 1fr 1fr;
            }
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

            .form-control {
                padding: 12px 14px;
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
                justify-content: center;
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

            .form-control {
                padding: 10px 12px;
                font-size: 15px;
            }

            .btn {
                padding: 10px 15px;
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
                    <h1>Booking Ruangan untuk Acara</h1>
                    <p>Ajukan peminjaman untuk kegiatan khusus yang terencana.</p>
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Form Section -->
        <div class="neumorphic-panel">
            <form action="{{ route('booking.store') }}" method="POST" class="form-container">
                @csrf
                
                <!-- Room Selection -->
                <div class="form-group">
                    <label for="room_id">Pilih Ruangan</label>
                    <select name="room_id" id="room_id" class="form-control" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->nama_ruangan }} (Gedung {{ $room->gedung }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Purpose -->
                <div class="form-group">
                    <label for="keperluan">Keperluan Acara</label>
                    <input type="text" name="keperluan" id="keperluan" class="form-control" required placeholder="Contoh: Kelas Pengganti Matkul X">
                </div>

                <!-- Date Time Selection -->
                <div class="form-group">
                    <label>Waktu Acara</label>
                    <div class="datetime-group">
                        <div>
                            <label for="waktu_mulai" style="display: block; margin-bottom: 8px; font-size: 14px;">Mulai</label>
                            <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                        </div>
                        <div>
                            <label for="waktu_selesai" style="display: block; margin-bottom: 8px; font-size: 14px;">Selesai</label>
                            <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="button-group">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Permintaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>