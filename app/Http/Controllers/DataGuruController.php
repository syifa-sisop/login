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
        $guru2  = Guru::latest()->get();
        
        return view('admin.guru')->with([
            'user'  => Auth::user(),
            'gurus' => $gurus,
            'guru2' => $guru2,
        ]);
    }
    public function store(Request $request)
    {
        $this->model    = new Guru;
        $data           = $this->model->tambah_data($request);
        return redirect()->route('dataguru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $guru   = Guru::find($id);
        $input  = $request->all();
        $guru->fill($input)->save();

        return redirect()->route('dataguru.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $gurus     = Guru::find($id);
        $gurus->delete();
        return redirect()->route('dataguru.index')->with('success', 'Data berhasil dihapus!');
    }

}
