<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Guru;

class KelasController extends Controller
{
    public function index()
    {
        $this->model    = new Kelas;
        $this->guru     = new Guru;
        $data           = $this->model->show();
        $kelas2         = $this->model->pagination();
        $guru           = $this->guru->tampil_data();
        $guru2          = $this->guru->tampil_data();
        
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
        $this->model = new Kelas;
        $this->model->update_data($request, $id);
        return redirect()->route('kelas.index')->with('success', 'Data berhasil diupdate!');
    }

    public function show($id)
    {
        $this->model    = new Kelas;
        $data           = $this->model->tampil_siswa($id);
        $resource       = $this->model->cari($id);
        return view('Admin/detail_kelas')->with([
            'resource'  =>$resource, 
            'user'      => Auth::user(), 
            'data'      =>$data,
        ]);
    }

    public function destroy($id)
    {
        $this->model = new Kelas;
        $this->model->delete_data($id);
        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }
}
