<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nisn',
        'jenis_kelamin'
        //'tingkat_kelas'
    ];

    public function kelas()
    {
        return $this->belongsToMany('App\Models\Kelas', 'kelas_siswas', 'id_siswa', 'id_kelas');
    }
}

