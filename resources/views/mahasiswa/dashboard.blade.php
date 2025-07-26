<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <style>body { font-family: sans-serif; padding: 20px; } a { display: block; margin-bottom: 10px; }</style>
</head>
<body>
    <h1>Dashboard Mahasiswa</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <hr>

    <a href="{{ route('mahasiswa.jadwal.index') }}">Lihat Jadwal Kuliah</a>
    {{-- TOMBOL BARU --}}
    <a href="{{ route('mahasiswa.history.index') }}">Riwayat Permintaan Saya</a>
    <a href="{{ route('scanner.show') }}">Scan Ruangan (Akses Cepat)</a>
    <a href="{{ route('booking.create') }}">Booking Ruangan (Untuk Acara)</a>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</body>
</html>
