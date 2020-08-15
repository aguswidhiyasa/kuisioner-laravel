@extends("survey_baru.base")

@section('css')
    <style>
        .error_wrapper > p {
            color: red;
        }
    </style>
@endsection

@section("content")
    <div class="pertanyaan-container loading">
        <div class="pertanyaan center">
            <p>Sedang Memuat Pertanyaan</p>
            <div class="lds-ring"></div>
        </div>
    </div>

    <div class="pertanyaan-container alert-tunggu" style="display: none">
        <div class="alert alert-warning">
            <strong>Harap tunggu!</strong> Sedang melakukan perhitungan
        </div>
    </div>

    <div class="pertanyaan-container content" style="display: none">
        <h2>Pertanyaan <span class="q-number"></span> dari <span class="q-total"></span></h2>
        <div class="pertanyaan">
            <div class="form">
                @include('survey_baru._question', ['questionNumber' => 'index1'])
                @include('survey_baru._question', ['questionNumber' => 'index2'])
                @include('survey_baru._question', ['questionNumber' => 'index3'])
                @include('survey_baru._question', ['questionNumber' => 'index4'])
                @include('survey_baru._question', ['questionNumber' => 'index5'])
            </div>
            <div class="custom-control custom-button">
                {{-- <button type="submit" class="btn btn-prev" onpress="mejik()">Mejik</button> --}}
                <button type="submit" class="btn btn-prev sebelumnya">Sebelumnya</button>
                <button type="submit" class="btn btn-next selanjutnya">Selanjutnya</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var pertanyaan = [],
            jawaban = [],
            totalPertanyaan = 0,
            lastIndexPertanyaan = 0,
            totalPage = 1;

        var $pertanyaan = $('.form'),
            $qnumber = $('.q-number'),
            $qtotal = $('.q-total');

        var pertanyaanPerPage = 5;

        $(function () {
            // get pertanyaan
            $.get('{{ route('survey.baru.init', ['id' => $id]) }}', function (data) {
                pertanyaan = data.data;
                if (data.status === 'success') {
                    pertanyaan = data.data;
                    totalPertanyaan = pertanyaan.length;
                    totalPage = Math.floor(totalPertanyaan / pertanyaanPerPage);
                    $qtotal.html(totalPertanyaan);
                    $('.pertanyaan-container.loading').toggle();
                    $('.pertanyaan-container.content').toggle();
                    renderPertanyaan();
                } else {
                    alert('Tidak bisa memuat data!');
                }
            });

            var errors = false, indexError = [], tempJawaban = [];
            $('.selanjutnya').click(function () {
                var tempLasIndex = lastIndexPertanyaan;
                lastIndexPertanyaan = lastIndexPertanyaan + 5;

                // reset to original state
                if (errors) {
                    lastIndexPertanyaan = tempLasIndex;
                    tempLasIndex = tempLasIndex - 5;
                }

                console.log('lastIndex: ' + lastIndexPertanyaan, 'total: ' + totalPertanyaan);

                var minSisa = (totalPertanyaan - tempLasIndex);
                var sisaPertanyaan = (minSisa < 5) ? minSisa: 5;

                errors = false;
                indexError = [];
                tempJawaban = [];
                // get jawaban dari setiap view
                for (var x = 1; x <= sisaPertanyaan; x++) {
                    var $sPertanyaanWrapper = $('.form-pertanyaan-wrapper.index' + x);
                    console.log('data-id',$sPertanyaanWrapper.attr('data-id'));
                    var value = $sPertanyaanWrapper.find('input[type="radio"][name="jawabanindex' + x + '"]:checked').val();
                    tempJawaban.push({
                        pertanyaan: $sPertanyaanWrapper.attr('data-id'),
                        jawaban: value
                    });
                    if (!value) {
                        errors = true;
                        indexError.push(x)
                    }
                }

                if (errors) {
                    indexError.forEach(function (value, index) {
                        console.log(value, 'errors');
                        $('.form-pertanyaan-wrapper.index' + value).find('.error_wrapper').html('<p>Pilih salah satu jawaban</p>');
                    });
                } else {
                    // if theres no error,, clean error
                    $('.form-pertanyaan-wrapper').find('.error_wrapper').html(' ');
                    // lastIndexPertanyaan = lastIndexPertanyaan + 5;
                    renderPertanyaan(lastIndexPertanyaan);
                    tempJawaban.forEach(function (value, index) {
                        jawaban.push(value);
                    });
                    errors = false;
                    // scroll to top
                    $('html,body').animate({
                        scrollTop: 0
                    }, 300);
                }

                if (lastIndexPertanyaan <= totalPertanyaan) {
                    // nothing todo here
                } else {
                    // getjawaban terakhir
                    // sisa pertanyaan;
                    submitJawaban();
                }
            });

            $('.sebelumnya').click(function () {
                renderBack();
            });
        });

        function renderPertanyaan(mulai = 0) {
            var sisa = totalPertanyaan - mulai;
            var ke = mulai + 5;//(sisa < 5) ? (mulai + sisa) : (mulai + 5);
            $qnumber.html((mulai + 1));
            // reset radio
            $('input[type="radio"]').prop('checked', false);
            var index = 1;
            for (var i = mulai; i < ke; i++) {
                var $pertanyaanWrapper = $('.form-pertanyaan-wrapper.index' + index);
                if (pertanyaan[i]) {
                    $pertanyaanWrapper.attr('data-id', pertanyaan[(i)].id);
                    $pertanyaanWrapper.find('.pertanyaan-text').html((i + 1) +'. '+pertanyaan[(i)].pertanyaan).change();
                } else {
                    $pertanyaanWrapper.html(' ').change();
                }
                index++;
            }
        }

        function renderBack() {
            $('input[type="radio"]').prop('checked', false);

            var lastIndex = lastIndexPertanyaan;

            if (lastIndexPertanyaan >= 5) {
                // render pertanyaan back 5
                var startIndex = lastIndex - 5;
                $qnumber.html((startIndex + 1));
                var indexItem = 1;
                for (var j = startIndex; j < lastIndex; j++) {
                    console.log(j, startIndex, lastIndex);
                    // console.log(pertanyaan[j]);
                    var $_pertanyaanWrapper = $('.form-pertanyaan-wrapper.index' + indexItem);
                    $_pertanyaanWrapper.attr('data-id', jawaban[j].pertanyaan);
                    $_pertanyaanWrapper.find('.pertanyaan-text').html((j + 1) +'. ' + pertanyaan[j].pertanyaan);
                    $_pertanyaanWrapper.find('input[type="radio"][value="' + jawaban[j].jawaban + '"]').prop('checked', true);
                    indexItem++;
                }

                // slice jawaban sebelumnya
                jawaban = jawaban.slice(0, lastIndexPertanyaan);

                // update lastIndexPertanyaan
                lastIndexPertanyaan = lastIndexPertanyaan - 5;
            }
        }

        // For testing purpose only
        function mejik() {
            var dataInput = [
                {pertanyaan: "1", jawaban: "KK"},
                {pertanyaan: "2", jawaban: "KK"},
                {pertanyaan: "3", jawaban: "TT"},
                {pertanyaan: "4", jawaban: "JJ"},
                {pertanyaan: "5", jawaban: "KK"},
                {pertanyaan: "6", jawaban: "TT"},
                {pertanyaan: "7", jawaban: "TT"},
                {pertanyaan: "8", jawaban: "TT"},
                {pertanyaan: "9", jawaban: "KK"},
                {pertanyaan: "38", jawaban: "TT"}, // 10
                {pertanyaan: "39", jawaban: "JJ"}, // 11
                {pertanyaan: "10", jawaban: "KK"}, // 12
                {pertanyaan: "11", jawaban: "KK"}, // 13
                {pertanyaan: "12", jawaban: "BB"}, // 14
                {pertanyaan: "13", jawaban: "TT"}, // 15
                {pertanyaan: "14", jawaban: "TT"}, // 16
                {pertanyaan: "15", jawaban: "TT"}, // 17
                {pertanyaan: "16", jawaban: "TT"}, // 18
                {pertanyaan: "17", jawaban: "TT"}, // 19
                {pertanyaan: "18", jawaban: "TT"}, // 20
                {pertanyaan: "19", jawaban: "BB"}, // 21
                {pertanyaan: "20", jawaban: "TT"}, // 22
                {pertanyaan: "21", jawaban: "KK"}, // 23
                {pertanyaan: "22", jawaban: "KK"}, // 24
                {pertanyaan: "23", jawaban: "TT"}, // 25
                {pertanyaan: "24", jawaban: "KK"}, // 26
                {pertanyaan: "25", jawaban: "BB"}, // 27
                {pertanyaan: "26", jawaban: "TT"}, // 28
                {pertanyaan: "27", jawaban: "TT"}, // 29
                {pertanyaan: "28", jawaban: "TT"}, // 30
                {pertanyaan: "29", jawaban: "TT"}, // 31
                {pertanyaan: "30", jawaban: "TT"}, // 32
                {pertanyaan: "31", jawaban: "TT"}, // 33
                {pertanyaan: "32", jawaban: "TT"}, // 34
                {pertanyaan: "33", jawaban: "TT"}, // 35
                {pertanyaan: "34", jawaban: "TT"}, // 36
                {pertanyaan: "35", jawaban: "TT"}, // 37
                {pertanyaan: "36", jawaban: "TT"}, // 38
                {pertanyaan: "37", jawaban: "TT"} // 39
            ];

            // console.log(dataInput);

            $.post(
                '{{ route('survey.baru.simpan') }}',
                {
                    _token: "{{ csrf_token() }}",
                    data: dataInput
                }
            ).done(function (data) {
                if (data.status === 'success') {
                    // window.location.reload();
                    console.log(data.data.uid);
                }
            }).fail(function () {
                alert('Tidak bisa menemukan jawaban');
                //location.reload();
            });
        }

        function submitJawaban() {
            $('.pertanyaan-container.alert-tunggu').toggle();
            $('.pertanyaan-container.content').html(' ').change();
            $.post(
                '{{ route('survey.baru.simpan') }}',
                {
                    _token: "{{ csrf_token() }}",
                    data: jawaban
                }
            ).done(function (data) {
                if (data.status === 'success') {
                    {{--location.href = '{{ route('user_question_finish') }}?u=' + data.data.uid;--}}
                }
            }).fail(function () {
                alert('Tidak bisa menemukan jawaban');
                //location.reload();
            });
        }
    </script>
@endsection
