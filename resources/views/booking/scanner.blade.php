<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan QR Code Ruangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Library untuk QR Scanner --}}
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
</head>
<body class="bg-gray-200 flex flex-col items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Pindai QR Code Ruangan</h1>
        
        {{-- Area untuk menampilkan kamera --}}
        <div id="qr-reader" class="w-full border-2 border-dashed rounded-lg"></div>
        
        <p id="qr-result" class="mt-4 text-gray-600">Arahkan kamera ke QR Code...</p>
        
        <a href="{{ url()->previous() }}" class="mt-6 inline-block bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
    </div>

    <script>
        let isProcessing = false; // Flag untuk mencegah scan berulang

        function onScanSuccess(decodedText, decodedResult) {
            if (isProcessing) return; // Jika sedang proses, abaikan scan baru
            isProcessing = true; // Set flag
            
            // Hentikan scanner
            html5QrcodeScanner.clear();
            
            document.getElementById('qr-result').innerText = `Kode terdeteksi: ${decodedText}. Memeriksa jadwal...`;

            // Kirim kode ke server via AJAX untuk divalidasi
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

                // Tampilkan SweetAlert berdasarkan respons dari server
                Swal.fire({
                    title: 'Konfirmasi Akses',
                    text: data.message,
                    icon: data.status === 'match' ? 'success' : 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Minta Akses!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika user setuju, kirim permintaan akses
                        requestAccess(data.room_id);
                    } else {
                        // Jika batal, reset scanner
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
            form.action = `/scan/${roomId}`; // URL disesuaikan
            
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
            }).then(resetScanner);
        }

        function resetScanner() {
            isProcessing = false;
            location.reload(); // Cara termudah untuk mereset
        }

        // Inisialisasi scanner
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
