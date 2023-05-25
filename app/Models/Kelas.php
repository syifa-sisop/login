<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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

    public function absen()
    {    
        return $this->belongsToMany('App\Models\Siswa', 'absensis', 'id_kelas', 'id_siswa')->withPivot('status', 'tanggal', 'keterangan')->wherePivot('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'));
    }

    
}
