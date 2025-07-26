<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_prodi',
        'deskripsi', // <-- Ini adalah nama kolom di tabel 'prodis'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}