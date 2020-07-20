<div class="card" data-id={{ $id }}>
    <div class="card-body">
        <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="deletequestion(this, {{ $id }})"><i class="fa fa-trash-o"></i> Hapus</a>
        <div class="form-group row">
            {!! Form::label('options_name', "Pertanyaan", ['class' => 'col-sm-2']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('pertanyaan[]', null, ['class' => 'form-control', 'id' => 'ck-editor' . $id ]) !!}
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        CKEDITOR.replace('ck-editor{{ $id }}'); 
    });
</script>