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
                        <td>Nama</td>
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
                            <td>{{ $nama }}</td>
                            <td>
                                @if ($assign->answered == "1")
                                    <a href="{{ route('kuisioner.download', [ 'id' => $assign->question_id ]) }}" class="btn btn-xs btn-success"><i class="fas fa-download"></i> Unduh Survey</a>
                                @endif
                                <a href="{{ route('kuisioner.delete', [ 'id' => $id, 'quisioner' => $assign->question_id ]) }}" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
@endsection

@section('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        var table = $('#kuisioner').DataTable();
    });
</script>
@endsection