<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;

class DataGuruController extends Controller
{
    public function index()
    {
        $guru   = Guru::all();
        $gurus  = Guru::paginate(5);
        $guru2 = Guru::latest()->get();
        
        return view('admin.guru')->with([
            'user' => Auth::user(),
            'gurus' => $gurus,
            'guru2' => $guru2,
        ]);
    }

    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'nama'  => 'required',
            'nip'  => 'required',
            'jenis_kelamin' => 'required'
        ]);
        // simpan
        Guru::create($request->all());

        // redirect
        return redirect()->route('dataguru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $guru  = Guru::find($id);
        $input  = $request->all();
        $guru->fill($input)->save();

        return redirect()->route('dataguru.index')->with('success', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $gurus     = Guru::find($id);
        $gurus->delete();

        return redirect()->route('dataguru.index')->with('success', 'Data berhasil dihapus!');
    }

}
