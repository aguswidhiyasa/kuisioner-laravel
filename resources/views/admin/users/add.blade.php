@extends('admin.master')

@section('title', "Tambah Pengguna")

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tambah Pengguna</h3>
        </div>
        <div class="card-body">
            {!! Form::open([ 'class' => 'form-horizontal' ]) !!}
            <div class="form-group row">
                <label for="nama_pengguna" class="col-form-label col-md-3 col-xs-12">Nama Pengguna</label>
                <div class="col-xs-9 col-xs-12">
                    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-form-label col-md-3 col-xs-12">Nama Pengguna</label>
                <div class="col-xs-9 col-xs-12">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_user" class="col-form-label col-md-3 col-xs-12">Tipe User</label>
                <div class="col-xs-4 col-xs-12">
                    {!! Form::select('tipe', ['GURU' => 'Guru', 'SISWA' => 'siswa'], null, [ 'class' => 'form-control' ]) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection