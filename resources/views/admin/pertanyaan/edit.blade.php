@extends('admin.master')

@section('title', "Edit Pertanyaan")

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Edit Pertanyaan
            </h3>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => route('pertanyaan.update')]) !!}
            {!! Form::hidden('id', $id, []) !!}
            <div class="form-group row">
                <label for="kategori" class="col-form-label col-sm-2">Kategori</label>
                <div class="col-sm-10">
                    {!! Form::select('kategori_id', $kategori, $pertanyaan->kategori_id, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="pertanyaan" class="col-form-lablel col-sm-2">Pertanyaan</label>
                <div class="col-sm-10">
                    {!! Form::textarea('pertanyaan', $pertanyaan->pertanyaan, ['class' => 'form-control', 'id' => 'ck-editor']) !!}
                </div>
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('ck-editor');
    });
</script>
@endsection