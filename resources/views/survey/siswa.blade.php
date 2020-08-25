@extends('survey.index')

@section('additional_info')
<div class="petunjuk-pengisian mt-6 mb-6">
    <h5 class="font-bold mb-4">Petunjuk Pengisian</h5>
    <ol>
        <li>Isilah identitas diri anda pada tempat data responden di bawah yaitu nama responden, kelas serta kompetensi keahlian.</li>
        <li>Dimohonkan kesediaan Siswa/Siswi untuk menjawab setiap nomor item angket dengan sejujurnya sesuai dengan petunjuk yang ada.</li>
        <li>Pilihlah jawaban dengan mengklik pada bulatan yang tersedia.</li>
        <li>Setiap pertanyaan harus dijawab, dan tidak boleh ada yang kosong.</li>
        <li>Tidak ada jawaban yang dianggap salah, benar, baik maupun buruk, karena itu Bapak/Ibu tidak perlu ragu dalam mengisi angket ini.</li>
        <li>Setelah selesai diisi. Jangan lupa tanda tangan pada kolom dibawah lalu klik simpan.</li>
    </ol>
</div>

<hr>

<div class="w-full max-w-sm mt-5">
    <div class="md:flex md:items-center mb-6 input_namalengkap">
        <div class="md:w-2/3">
            <label class="block text-black md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Nama Lengkap
            </label>
        </div>
        <div class="md:w-2/3">
            {!! Form::text('nama_lengkap', '', ['class' => 'appearance-none border-2 border-gray-500 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) !!}
        </div>
    </div>
</div>

<div class="w-full max-w-sm mt-5">
    <div class="md:flex md:items-center mb-6 input_kelas">
        <div class="md:w-2/3">
            <label class="block text-black md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Kelas
            </label>
        </div>
        <div class="md:w-2/3">
            {!! Form::select('add_info_kelas', ['X' => 'X', "XI" => "XI"], null, ['required' => 'required', 'class' => 'block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) !!}
        </div>
    </div>
</div>

<div class="w-full max-w-sm mt-5">
    <div class="md:flex md:items-center mb-6 input_komahli">
        <div class="md:w-2/3">
            <label class="block text-black md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Kompetensi Keahlian
            </label>
        </div>
        <div class="md:w-2/3">
            {!! Form::text('add_info_kompetensi', '', ['required' => 'required',  'class' => 'appearance-none border-2 border-gray-500 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500']) !!}
        </div>
    </div>
</div>

<hr>
@endsection
