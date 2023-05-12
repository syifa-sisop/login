@extends('layout.main')

@section('judul')
  Halaman Manajemen Data Guru
@endsection

@section('isi')

<form action="{{ route('dataguru.update', $guru->id_guru) }}" method="post">
	@csrf
	@method('PUT')

	<label for="">NIP</label><br>
	<input type="text" name="nip" id="" value="{{ $guru->nip }}"><br>

	<label for="">Nama</label><br>
	<input type="text" name="nama" id="" value="{{ $guru->nama }}"><br>

	<label for="">Jenis Kelamin</label><br>
	<input type="text" name="jenis_kelamin" id="" value="{{ $guru->jenis_kelamin }}"><br><br>


	<input type="submit" value="Save" class="btn btn-primary">
</form>

@endsection