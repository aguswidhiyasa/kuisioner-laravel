<div class="form-pertanyaan-wrapper {{$questionNumber}}">
    <div class="pertanyaan-text"></div>
    <div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="defaultUnchecked"
                   name="jawaban{{$questionNumber}}" value="SB">
            <label class="custom-control-label" for="defaultUnchecked">Sangat Baik</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="defaultUnchecked"
                   name="jawaban{{$questionNumber}}" value="BB">
            <label class="custom-control-label" for="defaultUnchecked">Baik</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="defaultUnchecked"
                   name="jawaban{{$questionNumber}}" value="KK">
            <label class="custom-control-label" for="defaultUnchecked">Kadang-kadang</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="defaultUnchecked"
                   name="jawaban{{$questionNumber}}" value="JJ">
            <label class="custom-control-label" for="defaultUnchecked">Jarang</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="defaultUnchecked"
                   name="jawaban{{$questionNumber}}" value="TT">
            <label class="custom-control-label" for="defaultUnchecked">Tidak</label>
        </div>
    </div>
    <div class="error_wrapper"></div>
</div>
