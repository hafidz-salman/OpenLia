<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ruangan', 'status', 'code',
        'deskripsi', 'gedung', 'foto', 'fasilitas'
    ];

    // Casting untuk kolom fasilitas
    protected $casts = [
        'fasilitas' => 'array',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function roomRequests()
    {
        return $this->hasMany(RoomRequest::class);
    }
    }