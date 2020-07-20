@extends('admin.master')

@section('title', "Kategori")

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Kategori</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('kategori.add') }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Kategori</a>
        <br>
        <br>
        <table id="table-categories" class="table table-bordered table-hover dataTable dtr-inline">
            <thead>
            <tr>
                <td width="10%">#</td>
                <td>Jenis</td>
                <td>Judul</td>
                <td width="15%">Action</td>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            var datauser = $('#table-categories').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('kategori.data') }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'judul', name: 'judul' },
                    { data: 'action', name: 'action' },
                ]
            });
        });
    </script>
@endsection
