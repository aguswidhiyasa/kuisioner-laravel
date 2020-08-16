@extends('admin.master')

@section('title', "Pengguna")

@section('css')
    <style>
        .monospace {
            font-family: 'Courier New', Courier, monospace;
        }
        .password {
            background-color: #eaeaea;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Daftar Pengguna
            </h3>
        </div>
        <div class="card-body">
            <table id="table-pengguna" class="table table-bordered dataTable dtr-inline">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Temp Password</td>
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
            var datauser = $('#table-pengguna').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.data') }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'mail', name: 'mail'},
                    { data: 'password', name: 'password' },
                ]
            });
        });
    </script>
@endsection