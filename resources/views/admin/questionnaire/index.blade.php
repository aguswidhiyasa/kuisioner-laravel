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
        <?php $bgColor = ['blue', 'green', 'yellow']; $i = 0; ?>
        @foreach($kategori as $kat)
        <div class="col-sm-4">
            <a href="{{ route('kuisioner.assign', ['id' => $kat->id]) }}">
            <div class="position-relative p-3 bg-{{ $bgColor[$i] }}" style="height: 180px">
                {{ $kat->judul }}<br>
            </div>
            </a>
        </div>
        <?php $i++; ?>
        @endforeach
    </div>
@endsection
