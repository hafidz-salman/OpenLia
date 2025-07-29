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

        $cleanedTodayIds = CleaningLog::whereDate('start_time', $now->toDateString())->pluck('room_id')->unique();
        $inUseRoomIds = Schedule::where('hari', $now->translatedFormat('l'))
                                ->where('jam_mulai', '<=', $now->format('H:i:s'))
                                ->where('jam_selesai', '>=', $now->format('H:i:s'))
                                ->pluck('room_id')->unique();
        $uncleanedRooms = Room::whereNotIn('id', $cleanedTodayIds)->orderBy('nama_ruangan')->get();
        $activeLog = CleaningLog::where('user_id', $petugasId)->whereNull('end_time')->first();
        $allRooms = Room::orderBy('nama_ruangan')->get();
        $totalLogs = CleaningLog::where('user_id', $petugasId)->count();

        return view('petugas.dashboard', compact(
            'uncleanedRooms', 
            'cleanedTodayIds', 
            'inUseRoomIds', 
            'activeLog',
            'allRooms',
            'totalLogs'
        ));
    }

    // ... (method startCleaning, endCleaning, startCleaningAll tetap sama) ...
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
        $cleanedTodayIds = CleaningLog::whereDate('start_time', $now->toDateString())->pluck('room_id')->unique();
        $inUseRoomIds = Schedule::where('hari', $now->translatedFormat('l'))
                                ->where('jam_mulai', '<=', $now->format('H:i:s'))
                                ->where('jam_selesai', '>=', $now->format('H:i:s'))
                                ->pluck('room_id')->unique();
        $roomsToClean = Room::whereNotIn('id', $cleanedTodayIds)->whereNotIn('id', $inUseRoomIds)->get();
        if ($roomsToClean->isEmpty()) {
            return back()->with('info', 'Tidak ada ruangan yang bisa dibersihkan saat ini.');
        }
        foreach ($roomsToClean as $room) {
            CleaningLog::create(['user_id' => $petugasId, 'room_id' => $room->id, 'start_time' => now(), 'end_time' => now()]);
        }
        return redirect()->route('petugas.dashboard')->with('success', $roomsToClean->count() . ' ruangan telah ditandai sebagai selesai dibersihkan.');
    }

    /**
     * Method untuk menampilkan riwayat pembersihan.
     */
    public function history()
    {
        $petugasId = Auth::id();
        $allUserLogs = CleaningLog::where('user_id', $petugasId);

        // Ambil data riwayat dengan paginasi
        $logs = $allUserLogs->with('room')->latest()->paginate(10);

        // --- PERBAIKAN DI SINI ---
        // Hitung semua statistik yang dibutuhkan oleh view
        $totalLogs = $allUserLogs->count();
        $ongoingLogs = $allUserLogs->whereNull('end_time')->count();
        $completedLogs = $totalLogs - $ongoingLogs;

        // Hitung rata-rata durasi (hanya untuk log yang sudah selesai)
        $totalDurationSeconds = CleaningLog::where('user_id', $petugasId)
                                    ->whereNotNull('end_time')
                                    ->get()
                                    ->sum(function ($log) {
                                        return Carbon::parse($log->start_time)->diffInSeconds($log->end_time);
                                    });
        
        $avgDuration = $completedLogs > 0 ? round($totalDurationSeconds / $completedLogs / 60) . ' menit' : 'N/A';


        return view('petugas.history', compact('logs', 'totalLogs', 'ongoingLogs', 'completedLogs', 'avgDuration'));
    }
}
