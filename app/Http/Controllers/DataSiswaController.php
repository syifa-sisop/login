<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        $this->model = new Siswa;
        $siswas = $this->model->search($request);

        return view('admin.siswa')->with([
            'user' => Auth::user(),
            'siswas' => $siswas,

        ]);
    }

    public function store(Request $request)
    {
        $this->model = new Siswa;
        $this->model->tambah_data($request);
        return redirect()->route('datasiswa')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $siswa  = Siswa::find($id);
        $input  = $request->all();
        $siswa->fill($input)->save();

        return redirect()->route('datasiswa')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $siswas     = Siswa::find($id);
        $siswas->delete();

        return redirect()->route('datasiswa')->with('success', 'Data berhasil dihapus!');
    }


    

}

