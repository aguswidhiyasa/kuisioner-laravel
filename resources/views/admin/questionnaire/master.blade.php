@extends('admin.master')

@section('title', "Input Kuisioner User")

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <style>
        .assign-button {
            margin-bottom: 20px;
        }

        .completed {
            background-color: #01f03e4d;
        }
    </style>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Kuisioner
            </h3>
        </div>
        <div class="card-body">
            <table id="kuisioner" class="table table-bordered">
                <thead>
                    <tr>
                        <td>No Kuisioner</td>
                        <td>Nama</td>
                        <td>Waktu Pengisian</td>
                        <td width="30%">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignQuestion as $assign)
                        <?php
                            $nama = $assign->name;
                            if ($assign->add_data != null) {
                                $addData = json_decode($assign->add_data);
                                $nama = $addData->nama_lengkap;
                            }
                        ?>
                        <tr {{ $assign->answered == "1" ? "class=completed" : ''}}>
                            <td>{{ $assign->nomor  }}</td>
                            <td>{{ $nama }}</td>
                            <td>{{ $assign->created_at }}</td>
                            <td>
                                @if ($assign->answered == "1")
                                    <a href="{{ route('kuisioner.download', [ 'id' => $assign->question_id ]) }}" class="btn btn-xs btn-success"><i class="fas fa-download"></i> Unduh Survey</a>
                                    <a href="javascript:void(0)" data-kategori="{{ $id }}" data-id="{{ $assign->question_id }}" class="btn btn-xs btn-primary ganti-nomor"><i class="fas fa-pencil-alt"></i> Edit No.</a>
                                @endif
                                <a href="{{ route('kuisioner.delete', [ 'id' => $id, 'quisioner' => $assign->question_id ]) }}" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-ganti-nomor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Nomor Kuisioner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open([ 'url' => '#', 'id' => 'form-ganti-nomor']) }}
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="questionnaireId">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nomor" class="col-sm-2 col-form-label">Nomor</label>
                        <div class="col-sm-12">
                            <input type="number" name="idBaru" class="form-control nomor">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        var table = $('#kuisioner').DataTable();

        $('.ganti-nomor').click(function() {
            var id = $(this).attr('data-id');
            var modalGantiNomor = $('#modal-ganti-nomor');
            $.get('{{ url('admin/kuisioner/assign/'. $id .'/edit') }}/' + id).done(function(data) {
                modalGantiNomor.find('.nomor').attr('value', data.nomor);
                modalGantiNomor.find('input[name="questionnaireId"]').attr('value', id);
                modalGantiNomor.modal('show');
            }).fail(function(data) {
                alert(data.message);
            })
        });

        $('#form-ganti-nomor').submit(function(e) {
            e.preventDefault();

            $.post('{{ route('kuisioner.updateNomor') }}', $(this).serialize())
                .done(function(data) {
                    setTimeout(function() {
                        $('#modal-ganti-nomor').modal('hide');
                    }, 300);
                    toastr.success(data.message);
                })
                .fail(function(data) {
                    toastr.error(data.message);
                });
        })
    });
</script>
@endsection
