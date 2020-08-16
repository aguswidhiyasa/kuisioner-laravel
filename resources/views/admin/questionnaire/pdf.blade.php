<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Survey</title>
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
<p>No. {{ $assignQuestion->id }}</p>
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
<ol>
    <li>Isilah identitas diri pada tempat data responden di atas yaitu nama responden dan mata pelajaran yang diempu responden (nomor di pojok kiri atas dikosongkan).</li>
    <li>Dimohonkan kesediaan Bapak/Ibu guru  untuk menjawab setiap nomor item angket dengan sejujurnya sesuai dengan petunjuk yang ada.</li>
    <li>Pilihlah jawaban dengan memberikan tanda (<span style="font-family: DejaVu Sans, sans-serif;">✔</span>) pada kolom pilihan Bapak/Ibu.</li>
    <li><strong>Setiap pertanyaan harus dijawab, dan tidak boleh ada yang kosong.</strong></li>
    <li>Tidak ada jawaban yang dianggap salah, benar, baik maupun buruk, karena itu Bapak/Ibu tidak perlu ragu dalam mengisi angket ini.</li>
    <li>Setelah selesai diisi, mohon angket ini agar segera dikembalikan kepada peneliti.</li>
</ol>

<p style="margin-left: 16px; font-size: 12px">Keterangan:</p>
<table style="margin-left: 16px">
    <tr>
        <td>SS</td>
        <td>: Sangat Setuju</td>
    </tr>
    <tr>
        <td>S</td>
        <td>: Setuju</td>
    </tr>
    <tr>
        <td>KS</td>
        <td>: Kurang Setuju</td>
    </tr>
    <tr>
        <td>TS</td>
        <td>: Tidak Setuju</td>
    </tr>
    <tr>
        <td>STS</td>
        <td>: Sangat Tidak Setuju</td>
    </tr>
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
        <td width="9%"><p align="center">SS</p></td>
        <td width="9%"><p align="center">S</p></td>
        <td width="9%"><p align="center">RR</p></td>
        <td width="9%"><p align="center">KS</p></td>
        <td width="9%"><p align="center">STS</p></td>
    </tr>
    </thead>
    <tbody>
    <?php $no = 1; ?>
    @foreach($jawabanOption as $option)
        <tr>
            <td>{{ $no }}.</td>
            <td>{!! $option->pertanyaan !!}</td>
            @foreach($questionOptions as $qo)
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
