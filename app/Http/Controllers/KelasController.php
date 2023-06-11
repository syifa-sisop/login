<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\KelasSiswa;

class KelasController extends Controller
{
    public function index()
    {
        $guru    = Guru::all();
        $guru2   = Guru::all();
        $kelas   = Kelas::all();
        $kelas2  = Kelas::paginate(5);

        $this->model    = new Kelas;
        $data           = $this->model->show();
        
        return view('admin.kelas')->with([
            'user'      => Auth::user(),
            'kelas2'    => $kelas2,
            'guru'      => $guru,
            'guru2'     => $guru2,
            'data'      => $data,
        ]);
    }

    public function store(Request $request)
    {
        
        $this->model = new Kelas;
        $this->model->tambah_data($request);
        return redirect()->route('kelas.index');
    }

    public function update(Request $request, $id)
    {
        $guru  = Guru::find($id);
        $kelas = Kelas::find($id);
        $input = $request->all();
        $kelas->fill($input)->save();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil diupdate!');
    }

    public function show($id){
        $resource       = Kelas::find($id);
        $this->model    = new Kelas;
        $data           = $this->model->tampil_siswa($id);

        return view('Admin/detail_kelas', ['resource'=>$resource, 'user' => Auth::user(), 'data' =>$data]);
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }

    public function delete($id)
    {
        $siswa = KelasSiswa::find($id);
        $siswa->delete();
        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }

}
