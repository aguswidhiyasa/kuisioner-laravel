@extends('admin.master')

@section('title', "Tambah Pertanyaan")

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tambah Pertanyaan</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => route('pertanyaan.store'), 'class' => 'form-horizontal']) !!}
            <div class="form-group row">
                <label for="kategori" class="col-form-label col-sm-2">Kategori</label>
                <div class="col-sm-10">
                    {!! Form::select('kategori_id', $kategori, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="pertanyaan-wrapper"></div>
            <div class="form-group">
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="tambah-pertanyaan">Tambah Pertanyaan</a>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <template id="pertanyaan">
        
    </template>
@endsection

@section('js')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var incrementer = 1;
        $(function() {

            $('#tambah-pertanyaan').click(function() {
                $.get('{{ url('admin/pertanyaan/tambah-pertanyaan') }}/' + incrementer, function(data) {
                    $('.pertanyaan-wrapper').append(data);
                    incrementer++;
                });
            });
        });

        function deletequestion(e, id) {
            $(e).parent().remove();
        }
    </script>
@endsection