@extends('admin.master')

@section('title', "Assign Question")

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Tambah User Questionnaire
            </h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                Pilih User dan tipe Kuisioner berikut untuk menambahkan ke Kuisioner
            </div>

            <div id="show-loading"></div>
            <div class="kuisioner-form">
                {{ Form::open(['url' => route('kuisioner.simpan'), 'id' => 'kuisioner-form']) }}
                <div class="form-group">
                    {!! Form::label('jenis_kuisioner', 'Jenis Kuisioner', []) !!}
                    {!! Form::select('jenis', $selectCategories, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user', 'Pilih User', []) !!}
                </div>
                <table id="table-kuisioner" class="table table-bordered">
                    <thead>
                        <tr>
                            <td width="40px"></td>
                            <td>Nama</td>
                            <td>Email</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><input type="checkbox" name="users[]" value="{{ $user->user_id }}" class="user-check"></td>
                            <td>{{ $user->name  }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <button class="btn btn-success"> Simpan</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        var loadingStatus = '<p><span class="fa fa-spin fa-spinner"></span> Loading ...</p>';
        $(function() {
            var showLoading = $('#show-loading');
            var table = $('#table-kuisioner').DataTable();

            $('#kuisioner-form').submit(function(e) {
                e.preventDefault();
                var form = $(this).serializeArray();
                var selected = [];

                table.column(0).nodes().to$().each(function(index) {    
                    var that = $(this).find('.user-check');
                    if (that.is(':checked')) {
                        selected.push({
                            'name': 'users[]',
                            'value': that.val()
                        });
                    }
                });

                var newform = $.map(form, function(data) {
                    if (data.name !== 'users[]') {
                        return data;
                    }
                });
                newform = newform.concat(selected);

                $('.kuisioner-form').toggle();
                showLoading.html(loadingStatus);
                $.post("{{ route('kuisioner.simpan') }}", newform)
                    .done(function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                    }).fail(function(data) {
                        toastr.error(data.message);
                    });
            })
        })
    </script>
@endsection