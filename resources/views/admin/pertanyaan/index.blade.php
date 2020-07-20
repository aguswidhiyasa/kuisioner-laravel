@extends('admin.master')

@section('title', "Pertanyaan")

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Pertanyaan</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('pertanyaan.add') }}" class="btn btn-success"><i class="fa fa-add"></i> Tambah Pertanyaan</a>
        </div>
    </div>
@endsection