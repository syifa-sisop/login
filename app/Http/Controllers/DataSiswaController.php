<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class DataSiswaController extends Controller
{
    public function index()
    {
        $siswa   = Siswa::all();
        $siswas  = Siswa::paginate(5);
        //$guru2 = Siswa::latest()->get();
        
        return view('admin.siswa')->with([
            'user' => Auth::user(),
            'siswas' => $siswas,
           // 'guru2' => $guru2,
        ]);
    }

    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'nama'  => 'required',
            'nisn'  => 'required',
            'jenis_kelamin' => 'required',
            'tingkat_kelas'  => 'required'
        ]);
        // simpan
        Siswa::create($request->all());

        // redirect
        return redirect()->route('datasiswa.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $siswa  = Siswa::find($id);
        $input  = $request->all();
        $siswa->fill($input)->save();

        return redirect()->route('datasiswa.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $siswas     = Siswa::find($id);
        $siswas->delete();

        return redirect()->route('datasiswa.index')->with('success', 'Data berhasil dihapus!');
    }

}

