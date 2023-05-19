<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\KelasSiswa;
use App\Models\Absensi;
use DB; 


class RekapController extends Controller
{
    public function index()
    {
        $kelas2  = Kelas::paginate(5);
        $data = DB::table('kelas')
                    ->join('gurus', 'gurus.id', '=', 'kelas.wali_kelas')
                    ->get(['kelas.nama_kelas','kelas.tingkat_kelas','kelas.kuota','kelas.id','kelas.thn_masuk','kelas.thn_keluar','gurus.nama']);
        //$guru2 = Kelas::latest()->get();
        
        return view('admin.rekap')->with([
            'user'      => Auth::user(),
            'data'      => $data,
            'kelas2'    => $kelas2,
           
        ]);
    }

    public function show($id)
    {
        $data = DB::table('absensis')
                    ->join('kelas', 'kelas.id', '=', 'absensis.id_kelas')
                    ->join('siswas', 'siswas.id', '=', 'absensis.id_siswa')
                    ->where('absensis.id_kelas',$id)
                    ->get(['absensis.id','siswas.nama','siswas.nisn','siswas.jenis_kelamin', 'absensis.status', 'absensis.tanggal']);

        return view('Admin/detail_absen', ['user' => Auth::user(), 'data' =>$data]);
    }
}
