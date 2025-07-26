<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'mata_kuliah', 'user_id', 'room_id', 'prodi_id',
        'angkatan', 'hari', 'jam_mulai', 'jam_selesai',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function room() { return $this->belongsTo(Room::class); }
    public function prodi() { return $this->belongsTo(Prodi::class); }
}