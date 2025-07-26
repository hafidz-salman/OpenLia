<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleChangeRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id', 'user_id', 'alasan', 'hari_baru',
        'jam_mulai_baru', 'jam_selesai_baru', 'status',
    ];

    public function schedule() { return $this->belongsTo(Schedule::class); }
    public function user() { return $this->belongsTo(User::class); }
}