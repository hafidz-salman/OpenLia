<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Perubahan Jadwal</title>
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
            margin-bottom: 20px;
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

        /* Form Styles */
        .form-container {
            width: 100%;
        }

        .current-schedule {
            background-color: var(--lighter-gray);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: inset 2px 2px 5px var(--shadow-color),
                        inset -2px -2px 5px #ffffff;
        }

        .current-schedule p {
            margin-bottom: 8px;
            font-size: 16px;
        }

        .current-schedule strong {
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }

        /* Neumorphic Input Styles */
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: var(--light-gray);
            border: none;
            border-radius: 8px;
            box-shadow: inset 3px 3px 6px var(--shadow-color),
                        inset -3px -3px 6px #ffffff;
            font-size: 16px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-control:focus {
            outline: none;
            box-shadow: inset 4px 4px 8px var(--shadow-color),
                        inset -4px -4px 8px #ffffff;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            margin: 25px 0 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
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

            .form-control {
                padding: 10px 12px;
                font-size: 15px;
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

            .current-schedule {
                padding: 15px;
            }

            .current-schedule p {
                font-size: 14px;
            }

            .section-title {
                font-size: 16px;
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
                    <h1>Ajukan Perubahan Jadwal</h1>
                    <p>Isi detail perubahan yang Anda usulkan.</p>
                </div>
                <a href="{{ route('dosen.dashboard') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali ke Jadwal
                </a>
            </div>
        </div>

        <!-- Form Section -->
        <div class="neumorphic-panel">
            <form action="{{ route('dosen.jadwal.change.store', $schedule) }}" method="POST" class="form-container">
                @csrf
                
                <!-- Current Schedule Info -->
                <div class="current-schedule">
                    <p><strong>Mata Kuliah:</strong> {{ $schedule->mata_kuliah }}</p>
                    <p><strong>Jadwal Lama:</strong> {{ $schedule->hari }}, {{ date('H:i', strtotime($schedule->jam_mulai)) }} - {{ date('H:i', strtotime($schedule->jam_selesai)) }}</p>
                </div>

                <!-- Reason for Change -->
                <div class="form-group">
                    <label for="alasan">Alasan Perubahan</label>
                    <textarea name="alasan" id="alasan" class="form-control" required></textarea>
                </div>

                <!-- New Schedule Proposal -->
                <h3 class="section-title">Usulan Jadwal Baru</h3>
                
                <div class="form-group">
                    <label for="hari_baru">Hari Baru</label>
                    <select name="hari_baru" id="hari_baru" class="form-control" required>
                        @foreach($haris as $hari)
                            <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jam_mulai_baru">Jam Mulai Baru</label>
                    <input type="time" name="jam_mulai_baru" id="jam_mulai_baru" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="jam_selesai_baru">Jam Selesai Baru</label>
                    <input type="time" name="jam_selesai_baru" id="jam_selesai_baru" class="form-control" required>
                </div>

                <!-- Action Buttons -->
                <div class="button-group">
                    <a href="{{ route('dosen.dashboard') }}" class="btn btn-secondary">
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