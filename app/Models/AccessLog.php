<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'action'];

    /**
     * Mendefinisikan relasi bahwa satu log "milik" satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi bahwa satu log "milik" satu Ruangan.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}