<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user();

        // Ambil jadwal yang prodinya sama DAN angkatannya sama dengan tahun masuk mahasiswa
        $jadwalKuliah = Schedule::where('prodi_id', $mahasiswa->prodi_id)
                                ->where('angkatan', $mahasiswa->tahun_masuk)
                                ->with(['user', 'room', 'prodi']) // Ambil data relasi
                                ->latest()
                                ->get();
                                
        return view('mahasiswa.schedules.index', compact('jadwalKuliah'));
    }
}
