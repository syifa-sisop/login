@extends('layout.main')

@section('judul')
  Halaman Absensi 
@endsection
@section('isi')

<div class="card">
        <div class="card-header">
          <h3 class="card-title">Selamat Datang, {{ $user->name }}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

          <div>
          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            
                   {{ session('success') }}
          </div>
          @endif
        </div>


        <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Absensi Siswa Kelas  {{$kelas2->tingkat_kelas. "-".$kelas2->jurusan. " " .$kelas2->nama_kelas." (".(Carbon\Carbon::now('Asia/Jakarta')->format('d F Y')).")"}}</div>
                <form action="/absensi" method="post">
                    <input type="hidden" name="kelas" value="{{$kelas2->id}}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="absensi" class="table table-bordred table-striped">
                                    <thead>
                                        <tr>
 
                                            <th width="3%" class="text-center">No</th>
                                            <th width="20%">NISN</th>
                                            <th width="20%">Nama Siswa</th>
                                            <th width="15%" colspan="3" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="isi">
                                        @foreach ($kelas2->siswa as $index => $res)
                                        
                                        <tr>
                                            <input type="hidden" name="siswa[]" value="{{$res->id}}">
      
                                            <td class="text-center">{{ $index+1 }}</td>
                                            <td>{{ $res->nisn}}</td>
                                            <td>{{ $res->nama}}</td>
                                            <td>

                                                @if($kelas2->absen->count()!=0)
                                                @foreach($kelas2->absen as $absen)
                                                    @if($absen->nisn==$res->nisn && $absen->pivot->tanggal==Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                                                        <p>{{$absen->pivot->status}}</p>
                                                        @break
                                                    @else
                                                        @if($loop->last)
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Hadir" checked>Hadir
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Alfa" >Alfa
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Izin" >Izin
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Sakit" >Sakit
                                                            </label>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @else
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Hadir" checked>Hadir
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Alfa" >Alfa
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Izin" >Izin
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Sakit" >Sakit
                                                            </label>
                                                @endif
                                                
                                                
                                            </td>


                                            

                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <p data-placement="top" data-toggle="tooltip" title="Add" class="pull-right"><button class="btn btn-primary btn-sm" type="submit" data-title="Add">Submit</button></p>
                        </div>
                    </div>
                </form>
            </div>

        </div><!--/.row-->

         </div>
@endsection