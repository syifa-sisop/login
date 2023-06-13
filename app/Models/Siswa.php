<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nisn',
        'jenis_kelamin'
    ];

    public function kelas()
    {
        return $this->belongsToMany('App\Models\Kelas', 'kelas_siswas', 'id_siswa', 'id_kelas');
    }

    public function search($request)
    {
        $siswa = Siswa::where([
            ['nama', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('nama', 'LIKE', '%' . $s . '%')
                        ->orWhere('nisn', 'LIKE', '%' . $s . '%')
                        ->orWhere('jenis_kelamin', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(5);

        return $siswa;
    }

    public function tambah_data($request)
    {
        $check = Siswa::where(['nisn' => $request->nisn])->get();
        if($check->count()>0){
            session()->flash('notif', array('success' => false, 'msgaction' => 'Tambah Data Gagal, Data Telah Ada!'));
            return redirect()->route('datasiswa');
        }else{
            $request->validate([
            'nama'          => 'required',
            'nisn'          => 'required',
            'jenis_kelamin' => 'required'
        ]);
        Siswa::create($request->all());
        }

    }

    public function update_data($request, $id)
    {
        $siswa  = Siswa::find($id);
        $input  = $request->all();
        $siswa->fill($input)->save();
    }

    public function delete_data($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
    }

}

