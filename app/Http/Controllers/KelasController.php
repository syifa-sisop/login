<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\KelasSiswa;
use DB; 

class KelasController extends Controller
{
    public function index()
    {
        $guru   = Guru::all();
        $guru2   = Guru::all();
        $kelas   = Kelas::all();
        $kelas2  = Kelas::paginate(5);

        $data = DB::table('kelas')
                    ->join('gurus', 'gurus.id', '=', 'kelas.wali_kelas')
                    ->get(['kelas.nama_kelas','kelas.tingkat_kelas','kelas.kuota','kelas.id','kelas.thn_masuk','kelas.thn_keluar','gurus.nama']);
        //$guru2 = Kelas::latest()->get();
        
        return view('admin.kelas')->with([
            'user' => Auth::user(),
            'kelas2' => $kelas2,
            'guru'  => $guru,
            'guru2' => $guru2,
            'data'  => $data,
           // 'guru2' => $guru2,
        ]);
    }
    public function create(Request $request)
    {
        $check = Kelas::where(['tingkat_kelas' => $request->tingkat_kelas, 
            'nama_kelas' => $request->nama_kelas, 'thn_masuk' => $request->thn_masuk, 'thn_keluar' => $request->thn_keluar])->get();
        if($check->count()>0){
            session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Data Telah Ada!'));
            return redirect()->route('kelas.index');
        }
        else{
            $Kelas = new Kelas;
            $Kelas->tingkat_kelas = $request->tingkat_kelas;
            $Kelas->nama_kelas = $request->nama_kelas;
            $Kelas->kuota = $request->kuota;
            $Kelas->thn_masuk = $request->thn_masuk;
            $Kelas->thn_keluar = $request->thn_keluar;
            $Kelas->wali_kelas = $request->wali_kelas;
            if($Kelas->save()){
                session()->flash('notif', array('success' => true, 'msgaction' => 'Tambah Data Berhasil!'));
            }
            else{
                session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Silahkan Ulangi!'));
            }
            return redirect()->route('kelas.index');
        }

    }

    public function update(Request $request, $id)
    {
        $guru  = Guru::find($id);
        $kelas = Kelas::find($id);
        $input  = $request->all();
        $kelas->fill($input)->save();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $kelas     = Kelas::find($id);
        $data = DB::table('kelas_siswas')
                    ->join('kelas', 'kelas.id', '=', 'kelas_siswas.id_kelas')
                    ->where('kelas.id', $id)
                    ->get();

        //$data->each()->delete();
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }

    public function show($id){
        $resource = Kelas::find($id);
        $data = DB::table('kelas_siswas')
                    ->join('kelas', 'kelas.id', '=', 'kelas_siswas.id_kelas')
                    ->join('siswas', 'siswas.id', '=', 'kelas_siswas.id_siswa')
                    ->where('kelas_siswas.id_kelas',$id)
                    ->get(['kelas_siswas.id','siswas.nama','siswas.nisn','siswas.jenis_kelamin']);

        return view('Admin/detail_kelas', ['resource'=>$resource, 'user' => Auth::user(), 'data' =>$data]);
    }

     public function destroy($id)
    {
        $kelassiswa     = KelasSiswa::find($id);
        $kelassiswa->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }

}
