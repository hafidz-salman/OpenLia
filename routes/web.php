<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoomRequestController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'redirect.after.login'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk proses peminjaman ruangan oleh user
Route::middleware(['auth'])->group(function () {
    Route::get('/booking/create', [\App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [\App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');

    // Rute untuk proses SCAN (akses langsung)
    Route::get('/scanner', [\App\Http\Controllers\BookingController::class, 'showScanner'])->name('scanner.show');
    Route::post('/scan/check', [\App\Http\Controllers\BookingController::class, 'checkSchedule'])->name('scan.check');
    Route::post('/scan/{room}', [\App\Http\Controllers\BookingController::class, 'handleScan'])->name('scan.handle');
});

// Rute baru untuk menampilkan gambar dari storage
Route::get('/storage-file/{path}', [\App\Http\Controllers\ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('storage.file');

// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        //Rute Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Rute untuk mengelola User
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        // Rute untuk mengelola Prodi
        Route::resource('prodi', \App\Http\Controllers\Admin\ProdiController::class);
        // Rute untuk mengelola Ruangan
        Route::resource('rooms', \App\Http\Controllers\Admin\RoomController::class);
        Route::get('/rooms/import', [\App\Http\Controllers\Admin\RoomController::class, 'showImportForm'])->name('rooms.import.show');
        Route::post('/rooms/import', [\App\Http\Controllers\Admin\RoomController::class, 'importExcel'])->name('rooms.import.store');
        Route::post('/rooms/{room}/override', [\App\Http\Controllers\Admin\RoomController::class, 'overrideAccess'])->name('rooms.override');
        // Rute untuk mengelola Jadwal
        Route::get('/schedules/import', [\App\Http\Controllers\Admin\ScheduleController::class, 'showImportForm'])->name('schedules.import.show');
        Route::post('/schedules/import', [\App\Http\Controllers\Admin\ScheduleController::class, 'importExcel'])->name('schedules.import.store');
        Route::resource('schedules', \App\Http\Controllers\Admin\ScheduleController::class);
        // Rute untuk menampilkan daftar permintaan
        Route::get('/requests', [\App\Http\Controllers\Admin\RoomRequestController::class, 'index'])->name('requests.index');
        // Rute untuk menyetujui permintaan
        Route::post('/requests/{roomRequest}/approve', [\App\Http\Controllers\Admin\RoomRequestController::class, 'approve'])->name('requests.approve');
        // Rute untuk menolak permintaan
        Route::post('/requests/{roomRequest}/reject', [\App\Http\Controllers\Admin\RoomRequestController::class, 'reject'])->name('requests.reject');
});

// GRUP RUTE UNTUK DOSEN
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        // Rute Dashboard Dosen
        Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');
        // Rute untuk menampilkan jadwal milik dosen yang sedang login
        Route::get('/jadwal', [\App\Http\Controllers\Dosen\ScheduleController::class, 'index'])->name('jadwal.index');
        // Rute untuk merubah jadwal kuliah
        Route::get('/jadwal/{schedule}/ajukan-perubahan', [\App\Http\Controllers\Dosen\ScheduleController::class, 'showChangeForm'])->name('jadwal.change.show');
        Route::post('/jadwal/{schedule}/ajukan-perubahan', [\App\Http\Controllers\Dosen\ScheduleController::class, 'storeChangeRequest'])->name('jadwal.change.store');
        // Rute untuk melihat user
        Route::get('/users', [\App\Http\Controllers\Dosen\UserController::class, 'index'])->name('users.index');
        // Rute untuk melihat history
        Route::get('/history', [\App\Http\Controllers\Dosen\HistoryController::class, 'index'])->name('history.index');
    
});

// GRUP RUTE UNTUK MAHASISWA
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {   
        // Rute Dashboard Mahasiswa
        Route::get('/dashboard', [\App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
        // Rute untuk menampilkan jadwal kuliah mahasiswa
        Route::get('/jadwal', [\App\Http\Controllers\Mahasiswa\ScheduleController::class, 'index'])->name('jadwal.index');
        // Rute untuk melihat history
        Route::get('/history', [\App\Http\Controllers\Mahasiswa\HistoryController::class, 'index'])->name('history.index');
});

// GRUP RUTE UNTUK PETUGAS KEBERSIHAN
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
        // Rute Dashboard Petugas Kebersihan
        Route::get('/dashboard', [\App\Http\Controllers\Petugas\DashboardController::class, 'index'])->name('dashboard');
        // Rute Untuk Memulai dan mengakhiri pembersihan ruangan / Mulai Bersihkan Semua
        Route::post('/cleaning/{room}/start', [\App\Http\Controllers\Petugas\DashboardController::class, 'startCleaning'])->name('cleaning.start');
        Route::post('/cleaning/{cleaningLog}/end', [\App\Http\Controllers\Petugas\DashboardController::class, 'endCleaning'])->name('cleaning.end');
        Route::post('/cleaning/start-all', [\App\Http\Controllers\Petugas\DashboardController::class, 'startCleaningAll'])->name('cleaning.start_all');
        // Rute untuk melihat history
        Route::get('/history', [\App\Http\Controllers\Petugas\DashboardController::class, 'history'])->name('history');
});

require __DIR__.'/auth.php';
