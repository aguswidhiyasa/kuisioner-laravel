@extends('admin.master')

@section('title', "Pengguna")

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('plugins/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus"></i> Tambah Pengguna
        </button>
        <br>
        <br>
        <table id="table-pengguna" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Email</td>
                    <td>Temp Password</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        {!! Form::open(['url' => '', 'class' => 'form-horizontal', 'id' => 'form-tambah-user']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="jumlah_user" class="col-form-label col-md-4 col-xs-6">Jumlah User</label>
                        <div class="col-md-8 col-xs-6">
                            {!! Form::number('jumlah', 0, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Jenis User" class="col-form-label col-md-4 col-xs-6">Jenis User</label>
                        <div class="col-md-8 col-xs-6">
                            {!! Form::select('jenis', ['GURU' => 'Guru', 'SISWA' => 'siswa'], null, ['class' =>
                            'form-control']) !!}
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        {!! Form::close() !!}
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
                { data: 'action', name: 'action' },
            ]
        });

        $('#form-tambah-user').submit(function(e) {
            e.preventDefault();

            $.post('{{ route('users.store') }}', $(this).serialize())
                .done(function(data) {
                    if (data.status == 'success') {
                        toastr.success(data.message, "Success");
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 700);
                    } else {
                        toastr.error("Terjadi Kesalahan", "Error");
                    }
                }).fail(function(data) {
                    toastr.error(data.message, "Error");
                });
        });
    });

    function hapus(e, id, nama) {
        if (confirm("Apakah Anda yakin ingin menghapus " + nama + "?\nMenghapus user akan menghapus seluruh data kuisioner user bersangkutan")) {
            $.post(
                "{{ route('users.delete') }}",
                { '_token': "{{ csrf_token() }}", 'id': id }
            ).done(function(data) {
                if (data.status == 'success') {
                    toastr.success(data.message, "Success");
                    setTimeout(function() {
                        window.location.reload(true);
                    }, 700);
                }
            }).fail(function(data) {
                toastr.success(data.message, "Success");
            });
        }
    }
</script>
@endsection