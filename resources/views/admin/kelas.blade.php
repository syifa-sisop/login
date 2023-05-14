@extends('layout.main')

@section('judul')
  Halaman Manajemen Data Kelas
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
          @if(session()->exists('notif'))

          @if(session()->get('notif')['success'])
          {!! 
          '<div class="alert alert-success alert-dismissable"> 
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <strong>Sukses! </strong>'. session()->get('notif')['msgaction'] .'
          </div>' 
          !!}
          @else
          {!! 
          '<div class="alert alert-danger alert-dismissable"> 
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <strong>Gagal! </strong>'. session()->get('notif')['msgaction'] .'
          </div>' 
          !!}
          @endif
          @endif
        </div>

          <!--<a href="{{ route('dataguru.create') }}" class="btn btn-primary">Add New</a><br><br>-->

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                  Add New
                </button><br><br>
          
          <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tingkat Kelas</th>
                      <th>Nama Kelas</th>
                      <th>Kuota</th>
                      <th>Tahun Pelajaran</th>
                      <th>Wali Kelas</th>
                      <th colspan="3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kelas2 as $kelas)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $kelas->tingkat_kelas }}</td>
                      <td>{{ $kelas->nama_kelas }}</td>
                      <td>{{ $kelas->kuota }}</td>
                      <td>{{ $kelas->thn_masuk }}/{{ $kelas->thn_keluar }}</td>
                       @foreach($data as $data)
                      <td>{{ $data->nama }}</td>
                      @endforeach

                      <td>
                        <a href="{{url('kelas/'.$kelas->id)}}"><button type="button" class="btn btn-success" > <i class="fas fa-eye"></i> Kelola</button></a>
                        
                        
                      </td>
                      
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit{{$kelas->id}}"> <i class="fas fa-edit"></i> Edit</button>
                        
                      </td>

                      <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$kelas->id}}"> <i class="fas fa-trash"></i> Delete</button>
                       
                       
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table><br>
                {{ $kelas2->links()}}
                <br>
        </div>
        <!-- /.card-body -->



      <!-- Add Modal -->
<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/kelas/" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tingkat_kelas">Tingkat Kelas</label>
                                <select class="form-control" name="tingkat_kelas">
                                    <option selected disabled>-Pilih Tingkat Kelas-</option>
                                    <option>I</option>
                                    <option>II</option>
                                    <option>III</option>
                                    <option>IV</option>
                                    <option>V</option>
                                    <option>VI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tingkat_kelas">Wali Kelas</label>
                                <select class="form-control" id="position-option" name="wali_kelas">
                                   @foreach ($guru as $guru)
                                      <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nomor_kelas">Nama Kelas</label>
                                <input class="form-control" type="text"  placeholder="Nama Kelas" name="nama_kelas">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="kuota">Kuota</label>
                                <input type="number" name="kuota" class="form-control" placeholder="Kuota Kelas">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="thn_masuk">Tahun Masuk</label>
                            <input class="form-control" type="number" name="thn_masuk" length=4 placeholder="Tahun Masuk">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="thn_keluar">Tahun Keluar</label>
                            <input class="form-control" type="number" name="thn_keluar" length=4 placeholder="Tahun Keluar">
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-info btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-plus"></span> Tambah Data</button>
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
</div>
<!--/add Modal -->

@foreach($kelas2 as $dt)
      <div class="modal fade" id="edit{{$dt->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data guru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! Form::model($data, ['method' => 'patch', 'route' => ['kelas.update', $dt->id] ]) !!}

              <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tingkat_kelas">Tingkat Kelas</label>
                                <select class="form-control" name="tingkat_kelas" value="{{ $dt->tingkat_kelas}}">
                                    <option selected disabled>{{ $dt->tingkat_kelas }}</option>
                                    <option>I</option>
                                    <option>II</option>
                                    <option>III</option>
                                    <option>IV</option>
                                    <option>V</option>
                                    <option>VI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tingkat_kelas">Wali Kelas</label>
                                
                                <select class="form-control" id="position-option" name="wali_kelas" value="{{ $dt->wali_kelas}}">
                                   @foreach ($guru2 as $gr)
                                      <option value="{{ $gr->id }}">{{ $gr->nama }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nomor_kelas">Nama Kelas</label>
                                <input class="form-control" type="text"  placeholder="{{ $dt->nama_kelas}}" name="nama_kelas" value="{{ $dt->nama_kelas}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="kuota">Kuota</label>
                                <input type="number" name="kuota" class="form-control" placeholder="{{ $dt->kuota}}" value="{{ $dt->kuota}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="thn_masuk">Tahun Masuk</label>
                            <input class="form-control" type="number" name="thn_masuk" length=4 placeholder="{{ $dt->thn_masuk}}" value="{{ $dt->thn_masuk}}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="thn_keluar">Tahun Keluar</label>
                            <input class="form-control" type="number" name="thn_keluar" length=4 placeholder="{{ $dt->thn_keluar}}" value="{{ $dt->thn_keluar}}">
                        </div>
                    </div>
              


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              {{Form::button('<i class="fa fa-check-square-o"></i> Update', ['class' => 'btn btn-success', 'type' =>'submit'])}}
              {!! Form::close() !!}
          
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="delete{{$dt->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! Form::model($dt, ['method' => 'delete', 'route' => ['kelas.delete', $dt->id] ]) !!}
                <h6 class="text-center">Apakah Anda Yakin Untuk Menghapus Data Ini ?</h4>
              


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              {{Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-danger', 'type' =>'submit'])}}
              {!! Form::close() !!}
          
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      @endforeach
     
      </div>
@endsection