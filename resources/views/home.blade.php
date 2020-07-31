@extends('layouts.app')

@section('content')
<div class="container mx-auto mb-4">
    <div class="w-full h-12">
        @foreach ($assignedQuestionnaire as $questionnaire)
        <div class="max-w-sm rounded overflow-hidden bg-white shadow-lg">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $questionnaire->judul }}</div>
            </div>
            <div class="px-6 py-4">
                @if ($questionnaire->answered != 1)
                <a href="{{ route('survey', ['id' => $questionnaire->question_id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Jawab Kuisioner
                </a>
                @else
                <a href="javscript:void(0)" class="bg-gray-300 text-black font-bold py-2 px-4 rounded-full">
                    Sudah Dijawab
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
