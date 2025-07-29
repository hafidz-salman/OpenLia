<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <style>
        :root {
            --primary-color: #5a67d8;
            --secondary-color: #f8fafc;
            --text-color: #2d3748;
            --light-gray: #f0f0f0;
            --lighter-gray: #fafafa;
            --shadow-color: #d1d5db;
        }

        body {
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .neumorphic-panel {
            background: var(--light-gray);
            border-radius: 20px;
            padding: 30px;
            box-shadow:  8px 8px 16px var(--shadow-color),
                        -8px -8px 16px #ffffff;
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .scanner-container {
            width: 100%;
            height: 300px;
            margin: 20px 0;
            border: 3px dashed rgba(45, 55, 72, 0.2);
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.3);
        }

        #qr-reader {
            width: 100%;
            height: 100%;
        }

        .status-text {
            color: var(--text-color);
            opacity: 0.8;
            margin: 15px 0 25px;
            font-size: 16px;
            min-height: 24px;
        }

        .glass-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--primary-color);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
        }

        .glass-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(90, 103, 216, 0.2);
        }

        h1 {
            color: var(--primary-color);
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .neumorphic-panel {
                padding: 20px;
            }
            
            .scanner-container {
                height: 250px;
            }
            
            h1 {
                font-size: 20px;
            }
            
            .status-text {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="neumorphic-panel">
        <h1>Pindai QR Code Ruangan</h1>
        
        <div class="scanner-container">
            <div id="qr-reader"></div>
        </div>
        
        <p id="qr-result" class="status-text">Arahkan kamera ke QR Code...</p>
        
        <a href="{{ url()->previous() }}" class="glass-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali
        </a>
    </div>

    <script>
        let isProcessing = false;

        function onScanSuccess(decodedText, decodedResult) {
            if (isProcessing) return;
            isProcessing = true;
            
            html5QrcodeScanner.clear();
            
            document.getElementById('qr-result').innerText = `Kode terdeteksi: ${decodedText}. Memeriksa jadwal...`;

            fetch("{{ route('scan.check') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ room_code: decodedText })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    showErrorAlert(data.message);
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi Akses',
                    text: data.message,
                    icon: data.status === 'match' ? 'success' : 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Minta Akses!',
                    cancelButtonText: 'Batal',
                    background: 'var(--light-gray)',
                    backdrop: `
                        rgba(0,0,0,0.4)
                        url("/images/nyan-cat.gif")
                        left top
                        no-repeat
                    `
                }).then((result) => {
                    if (result.isConfirmed) {
                        requestAccess(data.room_id);
                    } else {
                        resetScanner();
                    }
                });
            })
            .catch(error => {
                showErrorAlert('Gagal terhubung ke server.');
            });
        }

        function requestAccess(roomId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/scan/${roomId}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            document.body.appendChild(form);
            form.submit();
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
                background: 'var(--light-gray)'
            }).then(resetScanner);
        }

        function resetScanner() {
            isProcessing = false;
            location.reload();
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { 
                fps: 10, 
                qrbox: {width: 250, height: 250},
                formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ],
                experimentalFeatures: {
                    useBarCodeDetectorIfSupported: true
                }
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>