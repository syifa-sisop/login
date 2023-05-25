<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelasSiswa;
use App\Models\Absensi;
use App\Models\Kelas;
use Carbon\Carbon;
use DB;

class AbsensiController extends Controller
{
     public function index(){
        $kelas2     = Kelas::paginate(5);
        $this->model = new Absensi;
        $data = $this->model->tampil_absen();

        return view('admin/listkelas', ['kelas2'=>$kelas2, 'user' => Auth::user(), 'data'=> $data]);
    }
    public function show($id){
        $kelas2 = Kelas::find($id);
        return view('admin/absensi',['kelas2'=>$kelas2,'user' => Auth::user()]);
    }
    public function create(Request $request){
       
        for($i=0;$i<count($request->siswa);$i++){
            
            $check = Absensi::where(['id_siswa' => $request->siswa[$i],'id_kelas' => $request->kelas, 'tanggal' => Carbon::now('Asia/Jakarta')->format('Y-m-d')])->get();
            if(count($check)==0 && $request->status[$i] != "Hadir"){
                $absen = new Absensi;
                $absen->id_siswa = $request->siswa[$i];
                $absen->id_kelas = $request->kelas;
                $absen->tanggal = Carbon::now('Asia/Jakarta')->format('Y-m-d');
                $absen->status = $request->status[$i];
                $absen->keterangan = $request->status[$i];
                $absen->save();

            }


        }
        return redirect('/absensi');
    }
}
