@extends('layout.main')

@section('judul')
  Halaman Manajemen Data Guru
@endsection

@section('isi')

<h3>{{ $guru->nama }}</h3>

<p>Nip : {{ $guru->nip }}</p>
<p>Jenis Kelamin : {{ $guru->jenis_kelamin }}</p>

<a href="{{ route('dataguru.index') }}" class="btn btn-secondary">Back to Index</a>


@endsection