<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ScheduleChangeRequest;

class ScheduleController extends Controller
{
    public function index()
    {
        // Ambil ID dosen yang sedang login
        $dosenId = Auth::id();

        // Cari semua jadwal yang user_id-nya cocok dengan ID dosen
        $jadwalDosen = Schedule::where('user_id', $dosenId)
                                ->with(['room', 'prodi']) // Ambil juga data ruangan & prodi
                                ->latest()
                                ->get();
        
        return view('dosen.schedules.index', compact('jadwalDosen'));
    }

        // Method untuk menampilkan form
    public function showChangeForm(Schedule $schedule)
    {
        // Pastikan dosen hanya bisa mengubah jadwalnya sendiri
        if ($schedule->user_id !== auth::id()) {
            abort(403);
        }
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return view('dosen.schedules.change', compact('schedule', 'haris'));
    }

    // Method untuk menyimpan permintaan
    public function storeChangeRequest(Request $request, Schedule $schedule)
    {
        // Pastikan dosen hanya bisa mengubah jadwalnya sendiri
        if ($schedule->user_id !== auth::id()) {
            abort(403);
        }

        $request->validate([
            'alasan' => 'required|string',
            'hari_baru' => 'required|string',
            'jam_mulai_baru' => 'required',
            'jam_selesai_baru' => 'required|after:jam_mulai_baru',
        ]);

        ScheduleChangeRequest::create([
            'schedule_id' => $schedule->id,
            'user_id' => auth::id(),
            'alasan' => $request->alasan,
            'hari_baru' => $request->hari_baru,
            'jam_mulai_baru' => $request->jam_mulai_baru,
            'jam_selesai_baru' => $request->jam_selesai_baru,
        ]);

        return redirect()->route('dosen.jadwal.index')->with('success', 'Permintaan perubahan jadwal berhasil dikirim dan menunggu persetujuan Admin.');
    }

}