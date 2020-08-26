<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Survey - {{ $kategori->judul }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
    * {
        font-family: "Times New Roman", Serif;
    }

    h4 {
        font-size: 12px;
        font-weight: bold;
    }

    p, li {
        font-size: 12px;
    }

    table tr td,
    table tr th{
        font-size: 12px;
    }

    .table th, .table td, .table tr {
        vertical-align: middle !important;
        border: 1px solid black;
    }

    .table thead th {
        border-bottom: 1px solid black;
    }

    hr {
        border: 1px solid black;
    }
</style>
<?php 
    $nomor = explode('-', $jawaban->nomor);
?>
<p>No. {{ $nomor[1] }}</p>
<center style="font-weight: bold;">
    {{ $kategori->judul }}
</center>
<hr>

<h4>DATA RESPONDEN</h4>
<table style="margin-left: 16px">
    @foreach ($newInfo as $info)
        <tr>
            <td>{{ $info['title'] }}</td>
            <td>: {{ $info['value'] }}</td>
        </tr>
    @endforeach
</table>

<br>

<h4>PETUNJUK PENGISIAN</h4>
@include('admin.questionnaire._petunjuk-'. $kategori->template)

<p style="margin-left: 16px; font-size: 12px">Keterangan:</p>
<table style="margin-left: 16px">
    @foreach ($optionGroup->questionOptions as $option)
    <tr>
        <td>{{ $option->short_name }}</td>
        <td>: {{ $option->title }}</td>
    </tr>
    @endforeach
</table>

<br>
<br>

<table class='table'>
    <thead>
    <tr>
        <th rowspan="2" width="5%">No</th>
        <th rowspan="2" width="50%">Pertanyaan</th>
        <th colspan="5"><p align="center">Pilihan Jawaban</p></th>
    </tr>
    <tr>
        @foreach ($optionGroup->questionOptions as $option)
        <td width="9%"><p align="center">{{ $option->short_name }}</p></td>    
        @endforeach
    </tr>
    </thead>
    <tbody>
    <?php $no = 1; ?>
    @foreach($jawabanOption as $option)
        <tr>
            <td>{{ $no }}.</td>
            <td>{!! $option->pertanyaan !!}</td>
            @foreach($optionGroup->questionOptions as $qo)
                <td>
                @if ($qo->id == $option->option_id)
                    <p align="center"><div style="font-family: DejaVu Sans, sans-serif; font-size: 20px; text-align: center;">✔</div></p>
                @endif
                </td>
            @endforeach
        </tr>
        <?php $no++; ?>
    @endforeach
    </tbody>
</table>

<br>

<table width="300px" style="float: right">
    <tr>
        <td align="center" style="padding-bottom: 15px;">Singaraja, {{ date('d F Y', strtotime($jawaban->created_at)) }}</td>
    </tr>
    <tr>
        <td>
            <img src="{{  $tandaTangan->tanda_tangan }}" width="300px" alt="Tanda Tangn">
        </td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 15px;">({{ $namaLengkap }})</td>
    </tr>
</table>

</body>
</html>
