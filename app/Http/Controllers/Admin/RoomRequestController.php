<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomRequest;
use App\Models\Schedule; // <-- Import Schedule
use Illuminate\Http\Request;

class RoomRequestController extends Controller
{
    public function index()
    {
        // Ambil semua permintaan yang masih pending
        $requests = RoomRequest::where('status', 'pending')->with(['user', 'room'])->latest()->get();
        return view('admin.requests.index', compact('requests'));
    }

    public function approve(RoomRequest $roomRequest)
    {
        // 1. Ubah status permintaan menjadi 'approved'
        $roomRequest->update(['status' => 'approved']);

        // 2. Buat jadwal baru di tabel schedules berdasarkan permintaan
        Schedule::create([
            'mata_kuliah' => 'Peminjaman Ruangan: ' . $roomRequest->keperluan,
            'user_id'     => $roomRequest->user_id,
            'room_id'     => $roomRequest->room_id,
            'prodi_id'    => $roomRequest->user->prodi_id, // Ambil prodi dari user
            'angkatan'    => $roomRequest->user->tahun_masuk ?? now()->year, // Ambil angkatan, beri default tahun ini
            'hari'        => \Carbon\Carbon::parse($roomRequest->waktu_mulai)->format('l'), // Ambil hari dari waktu_mulai
            'jam_mulai'   => \Carbon\Carbon::parse($roomRequest->waktu_mulai)->format('H:i'),
            'jam_selesai' => \Carbon\Carbon::parse($roomRequest->waktu_selesai)->format('H:i'),
        ]);

        return back()->with('success', 'Permintaan berhasil disetujui dan jadwal telah dibuat.');
    }

    public function reject(RoomRequest $roomRequest)
    {
        $roomRequest->update(['status' => 'rejected']);
        return back()->with('success', 'Permintaan telah ditolak.');
    }
}