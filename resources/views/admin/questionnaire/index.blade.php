@extends('admin.master')

@section('title', 'Questionnaire')

@section('css')
    <style>
        .questionnaire-wrapper {
            width: 100%;
            background: white;
        }

        .questionnaire-title {
            padding: 15px;
        }

        .questionnaire-title h4 {
            font-size: 18px;
            text-align: center;
        }

        .questionnaire-action {
            background: lightgrey;
            padding: 15px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        @foreach($kategori as $kat)
        <div class="col-md-3">
            <div class="questionnaire-wrapper">
                <div class="questionnaire-title">
                    <h4>{{ $kat->judul }}</h4>
                </div>
                <div class="questionnaire-action">
                    <a href="{{ route('kuisioner.assign', ['id' => $kat->id]) }}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
