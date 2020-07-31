@extends('admin.master')

@section('title', "Tambah Kategori")

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tambah Kategori</h3>
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('kategori.store'), 'class' => 'form-horizontal']) }}
                <div class="form-group row">
                    {{ Form::label('nama_kategori', 'Nama Kategori', ['class' => 'col-sm-2 col-form-label']) }}
                    <div class="col-sm-10">
                        {{ Form::text('kategori', null, [ 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="from-group row" style="margin-bottom: 15px">
                    {!! Form::label('judul', 'Judul', ['class' => 'col-sm-2 col-from-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('option', "Options", ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('option_group', $optionGroup, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('tambahan_info', "Tambahan Info", ['class' => 'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('tambahan_info', null, ['class' => 'form-control']) !!}
                        <span class="help-block">Pisahkan dengan koma (,)</span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::submit('Simpan', ['class' => 'btn btn-success']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
