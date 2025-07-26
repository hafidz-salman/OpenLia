<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\RoomRequest;
use App\Models\ScheduleChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil riwayat permintaan peminjaman ruangan
        $roomRequests = RoomRequest::where('user_id', $userId)
                                    ->with('room') // Ambil data ruangan terkait
                                    ->latest()
                                    ->get();

        // Ambil riwayat permintaan perubahan jadwal
        $scheduleChangeRequests = ScheduleChangeRequest::where('user_id', $userId)
                                    ->with('schedule.room', 'schedule.user') // Ambil data jadwal & ruangan terkait
                                    ->latest()
                                    ->get();

        return view('dosen.history.index', compact('roomRequests', 'scheduleChangeRequests'));
    }
}
