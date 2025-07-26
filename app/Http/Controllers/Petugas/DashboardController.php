<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\CleaningLog;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $petugasId = Auth::id();
        $now = Carbon::now();

        // 1. Ambil ID semua ruangan yang sudah dibersihkan HARI INI
        $cleanedTodayIds = CleaningLog::whereDate('start_time', $now->toDateString()) // <-- PERBAIKAN
                                      ->pluck('room_id')
                                      ->unique();

        // 2. Ambil ID semua ruangan yang sedang digunakan sesuai jadwal SAAT INI
        $inUseRoomIds = Schedule::where('hari', $now->translatedFormat('l'))
                                ->where('jam_mulai', '<=', $now->format('H:i:s'))
                                ->where('jam_selesai', '>=', $now->format('H:i:s'))
                                ->pluck('room_id')->unique();

        // 3. Ambil daftar ruangan yang belum dibersihkan
        $uncleanedRooms = Room::whereNotIn('id', $cleanedTodayIds)->orderBy('nama_ruangan')->get();

        // 4. Cek sesi pembersihan yang sedang aktif oleh petugas ini
        $activeLog = CleaningLog::where('user_id', $petugasId)->whereNull('end_time')->first();

        return view('petugas.dashboard', compact(
            'uncleanedRooms', 
            'cleanedTodayIds', 
            'inUseRoomIds', 
            'activeLog'
        ));
    }

    public function startCleaning(Room $room)
    {
        $isActive = CleaningLog::where('user_id', Auth::id())->whereNull('end_time')->exists();
        if ($isActive) {
            return back()->with('error', 'Anda sudah memiliki sesi pembersihan yang aktif.');
        }
        CleaningLog::create(['user_id' => Auth::id(), 'room_id' => $room->id, 'start_time' => now()]);
        $room->update(['status' => 'Sedang Dibersihkan']);
        return back()->with('success', 'Sesi pembersihan untuk ruangan ' . $room->nama_ruangan . ' telah dimulai.');
    }

    public function endCleaning(CleaningLog $cleaningLog)
    {
        $cleaningLog->update(['end_time' => now()]);
        $cleaningLog->room->update(['status' => 'Tersedia']);
        return back()->with('success', 'Sesi pembersihan telah selesai.');
    }

    public function startCleaningAll()
    {
        $petugasId = Auth::id();
        $now = Carbon::now();

        if (CleaningLog::where('user_id', $petugasId)->whereNull('end_time')->exists()) {
            return back()->with('error', 'Selesaikan sesi pembersihan Anda saat ini terlebih dahulu.');
        }

        $cleanedTodayIds = CleaningLog::whereDate('start_time', $now->toDateString())->pluck('room_id')->unique(); // <-- PERBAIKAN
        
        $inUseRoomIds = Schedule::where('hari', $now->translatedFormat('l'))
                                ->where('jam_mulai', '<=', $now->format('H:i:s'))
                                ->where('jam_selesai', '>=', $now->format('H:i:s'))
                                ->pluck('room_id')->unique();
        
        $roomsToClean = Room::whereNotIn('id', $cleanedTodayIds)
                            ->whereNotIn('id', $inUseRoomIds)
                            ->get();

        if ($roomsToClean->isEmpty()) {
            return back()->with('info', 'Tidak ada ruangan yang bisa dibersihkan saat ini.');
        }

        foreach ($roomsToClean as $room) {
            CleaningLog::create([
                'user_id' => $petugasId,
                'room_id' => $room->id,
                'start_time' => $now,
                'end_time' => $now,
            ]);
        }

        return redirect()->route('petugas.dashboard')->with('success', $roomsToClean->count() . ' ruangan telah ditandai sebagai selesai dibersihkan.');
    }

    public function history()
    {
        $logs = CleaningLog::where('user_id', Auth::id())->with('room')->latest()->paginate(20);
        return view('petugas.history', compact('logs'));
    }
}
