<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Room;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SchedulesImport;

class ScheduleController extends Controller
{
    
    public function index(Request $request)
    {
        // Ambil semua data master untuk filter
        $prodis = \App\Models\Prodi::orderBy('nama_prodi')->get();
        $dosens = \App\Models\User::where('role', 'dosen')->orderBy('name')->get();
        $angkatans = \App\Models\Schedule::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->get();

        // Query dasar untuk jadwal
        $query = \App\Models\Schedule::with(['user', 'room', 'prodi']);

        // Terapkan filter jika ada
        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }
        if ($request->filled('dosen_id')) {
            $query->where('user_id', $request->dosen_id);
        }

        // Urutkan berdasarkan hari dan jam mulai
        $schedules = $query->orderBy('hari')->orderBy('jam_mulai')->get();

        return view('admin.schedules.index', compact('schedules', 'prodis', 'dosens', 'angkatans'));
    }

    public function create()
    {
        $dosens = User::where('role', 'dosen')->orderBy('name')->get();
        $rooms = Room::orderBy('nama_ruangan')->get();
        $prodis = Prodi::orderBy('nama_prodi')->get();
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return view('admin.schedules.create', compact('dosens', 'rooms', 'prodis', 'haris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'prodi_id' => 'required|exists:prodis,id',
            'angkatan' => 'required|integer',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);
        Schedule::create($request->all());
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal baru berhasil dibuat.');
    }

    public function edit(Schedule $schedule)
    {
        $dosens = User::where('role', 'dosen')->orderBy('name')->get();
        $rooms = Room::orderBy('nama_ruangan')->get();
        $prodis = Prodi::orderBy('nama_prodi')->get();
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return view('admin.schedules.edit', compact('schedule', 'dosens', 'rooms', 'prodis', 'haris'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'mata_kuliah' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'prodi_id' => 'required|exists:prodis,id',
            'angkatan' => 'required|integer',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);
        $schedule->update($request->all());
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
    
    public function showImportForm()
    {
        return view('admin.schedules.import');
    }

    public function importExcel(Request $request)
    {
        $request->validate(['excel_file' => 'required|mimes:xlsx,xls']);
        Excel::import(new SchedulesImport, $request->file('excel_file'));
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diimpor.');
    }
}