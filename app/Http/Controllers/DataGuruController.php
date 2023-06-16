<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;

class DataGuruController extends Controller
{
    public function index()
    {   
        $this->model    = new Guru;
        $gurus           = $this->model->pagination();

        return view('admin.guru')->with([
            'user'  => Auth::user(),
            'gurus' => $gurus,
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
        $this->model    = new Guru;
        $data           = $this->model->update_data($request, $id);
        
        return redirect()->route('dataguru.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $this->model    = new Guru;
        $data           = $this->model->delete_data($id);
        
        return redirect()->route('dataguru.index')->with('success', 'Data berhasil dihapus!');
    }
}
