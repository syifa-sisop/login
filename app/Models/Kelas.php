<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tingkat_kelas',
        'nama_kelas',
        'kuota',
        'thn_masuk',
        'thn_keluar',
        'wali_kelas',
    ];
    public $timestamps  = false;

    public function Siswa()
    {
        return $this->belongsToMany('App\Models\Siswa', 'kelas_siswas', 'id_kelas', 'id_siswa')->withPivot('id');
    }
}
