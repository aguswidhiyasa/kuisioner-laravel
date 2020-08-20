@extends('admin.master')

@section('title', "Pertanyaan")

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Pertanyaan</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('pertanyaan.add') }}" class="btn btn-success"><i class="fa fa-add"></i> Tambah Pertanyaan</a>
            <br>
            <br>

            <div class="kategori-filter-wrapper">
                <div class="form-group row">
                    <div class="col-md-8 col-xs-12"></div>
                    <label for="kategori_label" class="col-form-label col-md-2 col-xs-6">Filter Berdasarkan</label>
                    <div class="col-md-2 col-xs-6" style="float: right">
                        {!! Form::select('kategori', $categories, null, ['id' => 'kategori_filter', 'class' => 'form-control']) !!}
                    </div>
                </div>
                
            </div>
            
            <br>

            <table id="table-pertanyaan" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <td width="10%">#</td>
                    <td>Pertanyaan</td>
                    <td>Kategori</td>
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
            var datauser = $('#table-pertanyaan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('pertanyaan.data') }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'pertanyaan', name: 'pertanyaan' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'action', name: 'action' },
                ]
            });

            $('#kategori_filter').change(function() {
                var data = $(this).find(':selected').val();
                datauser.ajax.url('{{ route('pertanyaan.data') }}?jenis=' + data).load();
            });
        });

        function hapus(id, name) {
            if (confirm("Apakah Anda ingin menghapus " + name + "?")) {
                $.post('{{ route('pertanyaan.delete') }}', {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                }).done(function(data) {
                    toastr.success('Categories has been deleted');
                    setTimeout(function(data) {
                        window.location.reload(true);
                    }, 500);
                }).fail(function(data) {
                    toastr.error('Categories cant be deleted');
                });
            }
        }
    </script>
@endsection
