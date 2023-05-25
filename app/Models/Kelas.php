<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function show()
    {
        $data = DB::table('kelas')
                    ->join('gurus', 'gurus.id', '=', 'kelas.wali_kelas')
                    ->get(['kelas.nama_kelas','kelas.tingkat_kelas','kelas.kuota','kelas.id','kelas.thn_masuk','kelas.thn_keluar','gurus.nama']);

        return $data;
    }

    public function tampil_siswa($id)
    {
        //$kelas     = Kelas::find($id);
        $data = DB::table('kelas_siswas')
                    ->join('kelas', 'kelas.id', '=', 'kelas_siswas.id_kelas')
                    ->join('siswas', 'siswas.id', '=', 'kelas_siswas.id_siswa')
                    ->where('kelas_siswas.id_kelas',$id)
                    ->get(['kelas_siswas.id','siswas.nama','siswas.nisn','siswas.jenis_kelamin']);
        return $data;
    }
}
