@extends('survey.index')

@section('additional_info')
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
@endsection
