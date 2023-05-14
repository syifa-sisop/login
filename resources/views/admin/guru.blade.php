@extends('layout.main')

@section('judul')
  Halaman Manajemen Data Guru
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

          <!--<a href="{{ route('dataguru.create') }}" class="btn btn-primary">Add New</a><br><br>-->

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                  Add New
                </button><br><br>
          
          <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($gurus as $guru)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $guru->nip }}</td>
                      <td>{{ $guru->nama }}</td>
                      <td>{{ $guru->jenis_kelamin }}</td>
                      
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit{{$guru->id}}"> <i class="fas fa-edit"></i> Edit</button>
                        
                      </td>

                      <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$guru->id}}"> <i class="fas fa-trash"></i> Delete</button>
                       
                       
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table><br>
                {{ $gurus->links()}}
                <br>
        </div>
        <!-- /.card-body -->
     
      </div>


      <div class="modal fade" id="tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Guru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <form action="{{ route('dataguru.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">NIP</label>
                    <input type="text" class="form-control"  name="nip">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control"  name="nama">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <input type="text" class="form-control"  name="jenis_kelamin">
                </div>


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


    @foreach($gurus as $guru)
      <div class="modal fade" id="edit{{$guru->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data guru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! Form::model($gurus, ['method' => 'patch', 'route' => ['dataguru.update', $guru->id] ]) !!}
              <div class="mb-3">
                {!! Form::label('nip', 'NIP') !!}
                {!! Form::text('nip', $guru->nip, ['class' => 'form-control']) !!}
              </div>
              <div class="mb-3">
                {!! Form::label('nama', 'Nama') !!}
                {!! Form::text('nama', $guru->nama, ['class' => 'form-control']) !!}
              </div>   
              <div class="mb-3">
                {!! Form::label('jenis_kelamin', 'Jenis Kelamin') !!}
                {!! Form::text('jenis_kelamin', $guru->jenis_kelamin, ['class' => 'form-control']) !!}
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


      <div class="modal fade" id="delete{{$guru->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data guru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! Form::model($gurus, ['method' => 'delete', 'route' => ['dataguru.destroy', $guru->id] ]) !!}
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

@endsection

