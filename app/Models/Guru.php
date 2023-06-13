<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nip',
        'jenis_kelamin'
    ];

    public function tambah_data($request)
    {
        $request->validate([
            'nama'          => 'required',
            'nip'           => 'required',
            'jenis_kelamin' => 'required'
        ]);
        Guru::create($request->all());
    }

    public function pagination()
    {
        $guru  = Guru::paginate(5);
        return $guru;
    }

    public function update_data($request, $id)
    {
        $guru   = Guru::find($id);
        $input  = $request->all();
        $guru->fill($input)->save();
    }

    public function delete_data($id)
    {
        $gurus  = Guru::find($id);
        $gurus->delete();
    }
}
