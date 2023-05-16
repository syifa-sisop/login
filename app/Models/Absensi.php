<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'tanggal',
        'status',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsToMany('App\Models\Siswa');
    }
}

