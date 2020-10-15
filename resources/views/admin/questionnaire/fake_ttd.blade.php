@extends('admin.master')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Input tanda tangan
            </h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <p>Hanya Menampilkan kuisioner yang tidak memiliki tanda tangan</p>
            </div>
            {!! Form::open(['url' => '#', 'id' => 'fake_ttd']) !!}
            <div class="form-group">
                <label for="user">Nama Kuisioner</label>
                <select name="user" class="form-controller">
                    @foreach ($users as $user)
                        <option value="{{ $user['id'] }}">{{ $user['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div id="tanda-tangan">
                    <div class="text-base font-bold">Tanda Tangan</div>
                    <div class="tanda-tangan-wrapper border border-gray-500 rounded-md mt-1" style="width: 400px;">
                        <a href="javascript:void(0)" onclick="deletesignature()" class="btn hapus-ttd">Hapus</a>
                        <canvas></canvas>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('plugins/signature_pad/js/signature_pad.js') }}"></script>
<script type="text/javascript">
    var wrapper = document.getElementById("tanda-tangan");
    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, { });

    function resizeCanvas() {
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = 400;//canvas.offsetWidth * ratio;
        canvas.height = 400;canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(1, 1);
        signaturePad.clear(); // otherwise isEmpty() might return incorrect value
    }

    window.addEventListener("resize", resizeCanvas);
    resizeCanvas();

    function deletesignature() {
        signaturePad.clear();
    }

    function saveSignature() {
        if (signaturePad.isEmpty()) {
            alert("Please provide a signature first.");
            return null;
        } else {
            var dataURL = signaturePad.toDataURL();
            return dataURL;
        }
    }

    $(function() {
        $('#fake_ttd').submit(function(e) {
            e.preventDefault();

            var signature = saveSignature();
            if (signature) {
                var data = $(this).serializeArray();

                var formdata = new FormData();
                for (var i = 0; i < data.length; i++) {
                    formdata.append(data[i].name, data[i].value);
                }
                // $.each(data, function(el) {

                // });
                formdata.append('signature', signature);

                $.ajax({
                    url: '{{ url('admin/simpan-fake') }}',
                    data: formdata,
                    type: 'post',
                    processData: false,
                    contentType: false
                }).done(function (data) {
                    window.location.reload(true);
                }).fail(function (data) {
                    alert(data);
                });
            } else {
                alert('hmmm');
            }
        });
    });
</script>
@endsection