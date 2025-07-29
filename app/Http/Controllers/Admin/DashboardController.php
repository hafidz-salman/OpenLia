<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\RoomRequest;
use App\Models\AccessLog;
use App\Models\CleaningLog;
use App\Models\ScheduleChangeRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $todayName = $now->translatedFormat('l');

        // --- Statistik & Jadwal (Tetap Sama) ---
        $totalUsers = User::count();
        $totalRooms = Room::count();
        $inUseRoomIds = Schedule::where('hari', $todayName)
                                ->where('jam_mulai', '<=', $now->format('H:i:s'))
                                ->where('jam_selesai', '>=', $now->format('H:i:s'))
                                ->pluck('room_id')->unique();
        $roomsInUseCount = $inUseRoomIds->count();
        $availableRoomsCount = $totalRooms - $roomsInUseCount;
        $schedulesToday = Schedule::where('hari', $todayName)
                                  ->with(['user', 'room', 'prodi'])
                                  ->orderBy('jam_mulai')->get();
        $pendingRoomRequests = RoomRequest::where('status', 'pending')->count();

        // --- LOGIKA BARU UNTUK FEED AKTIVITAS ---
        $activityFeed = collect();

        // 1. Ambil Permintaan Ruangan
        $roomRequests = RoomRequest::with('user', 'room')->latest()->take(5)->get();
        foreach ($roomRequests as $item) {
            $activityFeed->push((object)[
                'user_name' => $item->user->name ?? 'User',
                'action' => "mengajukan permintaan untuk <strong>{$item->room->nama_ruangan}</strong>.",
                'time' => $item->created_at,
                'icon' => 'fa-inbox',
                'color' => 'yellow'
            ]);
        }

        // 2. Ambil Log Pembersihan
        $cleaningLogs = CleaningLog::with('user', 'room')->latest()->take(5)->get();
        foreach ($cleaningLogs as $item) {
            $actionText = $item->end_time ? 'menyelesaikan pembersihan' : 'memulai pembersihan';
            $activityFeed->push((object)[
                'user_name' => $item->user->name ?? 'User',
                'action' => "$actionText di <strong>{$item->room->nama_ruangan}</strong>.",
                'time' => $item->created_at,
                'icon' => 'fa-broom',
                'color' => 'green'
            ]);
        }

        // 3. Ambil Log Override
        $accessLogs = AccessLog::with('user', 'room')->where('action', 'OVERRIDE_OPEN')->latest()->take(5)->get();
        foreach ($accessLogs as $item) {
            $activityFeed->push((object)[
                'user_name' => $item->user->name ?? 'User',
                'action' => "melakukan override akses pada <strong>{$item->room->nama_ruangan}</strong>.",
                'time' => $item->created_at,
                'icon' => 'fa-bolt',
                'color' => 'purple'
            ]);
        }
        
        // Urutkan semua aktivitas berdasarkan waktu dan ambil 5 terbaru
        $sortedFeed = $activityFeed->sortByDesc('time')->take(5);

        return view('admin.dashboard', compact(
            'totalUsers', 'roomsInUseCount', 'availableRoomsCount',
            'schedulesToday', 'todayName', 'pendingRoomRequests',
            'sortedFeed' // Kirim data feed yang sudah diurutkan
        ));
    }
}
