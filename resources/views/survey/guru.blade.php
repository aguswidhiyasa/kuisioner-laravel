@extends('survey.index')

@section('additional_info')

<div class="w-full max-w-sm mt-5">
    <div class="md:flex md:items-center mb-6">
        <div class="md:w-2/3">
            <label class="block text-black md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Nama Lengkap
            </label>
        </div>
        <div class="md:w-2/3">
            {!! Form::text('nama_lengkap', '', ['required' => 'required', 'class' => 'bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500']) !!}
        </div>
    </div>

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-2/3">
            <label class="block text-black md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Guru Mata Pelajaran
            </label>
        </div>
        <div class="md:w-2/3">
            {!! Form::text('add_info_mapel', '', ['required' => 'required', 'class' => 'bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500']) !!}
        </div>
    </div>
</div>
@endsection
