<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\RoomRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengatur waktu dan hari saat ini
        $now = Carbon::now();
        $todayName = $now->translatedFormat('l'); // 'l' untuk nama hari, misal: 'Jumat'

        // 1. Statistik Utama
        $totalUsers = User::count();
        $totalRooms = Room::count();

        // 2. Statistik Ruangan
        $inUseRoomIds = Schedule::where('hari', $todayName)
                                ->where('jam_mulai', '<=', $now->format('H:i:s'))
                                ->where('jam_selesai', '>=', $now->format('H:i:s'))
                                ->pluck('room_id')
                                ->unique();
        
        $roomsInUseCount = $inUseRoomIds->count();
        $availableRoomsCount = $totalRooms - $roomsInUseCount;

        // 3. Jadwal Hari Ini
        $schedulesToday = Schedule::where('hari', $todayName)
                                  ->with(['user', 'room', 'prodi'])
                                  ->orderBy('jam_mulai')
                                  ->get();
        
        // 4. Permintaan Mendesak (Ide Tambahan)
        $pendingRoomRequests = RoomRequest::where('status', 'pending')->count();
        // Anda bisa menambahkan model dan query untuk schedule change requests di sini

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'roomsInUseCount',
            'availableRoomsCount',
            'schedulesToday',
            'todayName',
            'pendingRoomRequests'
        ));
    }
}
