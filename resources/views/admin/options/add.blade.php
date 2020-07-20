@extends('admin.master')

@section('title', "Tambah Opsi")

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tambah Opsi</h3>
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('options.store'), 'class' => 'form-horizontal']) }}
                <div class="form-group row">
                    {!! Form::label('title', "Judul", ['class' => 'col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="option-wrapper"></div>
                
                <div class="form-group">
                    <a href="#" class="btn btn-sm btn-primary tambah-opsi">Tambah Opsi</a>
                </div>

                <div class="form-group">
                    {!! Form::submit('Simpan', ['class' => 'btn btn-success']) !!}
                </div>
            {{ Form::close() }}
        </div>
    </div>

    <template id="options">
        <div class="row">
            <div class="col-md-5 col-xs-12">
                <div class="form-group">
                    {!! Form::label('options_name', "Nama Option", []) !!}
                    {!! Form::text('options[]', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="form-group">
                    {!! Form::label('options_name', "Nilai", []) !!}
                    {!! Form::text('option_value[]', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </template>
@endsection

@section('js')
    <script>
        $(function() {
            var template = $('#options').clone();

            $('.tambah-opsi').click(function() {
                $('.option-wrapper').append(template[0].content.cloneNode(true));
            });
        });
    </script>
@endsection