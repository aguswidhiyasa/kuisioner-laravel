@extends('admin.master')

@section('title', "Assign Question")

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                Tambah User Questionnaire
            </h3>
        </div>
        <div class="card-body">
            <p>Tambahkan pengguna kedalam Kuisioner <strong>{{ $kategori->judul }}</strong></p>
            <br>
            {{ Form::open(['url' => route('kuisioner.simpan')]) }}
            {{ Form::hidden('kategori', $id) }}
            <table class="table table-bordered">
                <tr>
                    <td width="40px"></td>
                    <td>Nama</td>
                    <td>Email</td>
                    <td width="200px">Aksi</td>
                </tr>
                @foreach($users as $user)
                    @if ($user->kategori_id == $id ||!isset($user->kategori_id))
                    <tr>
                        <td><input type="checkbox" name="users[]" class="user-check" value="{{ $user->user_id }}" {{ isset($user->answered) ? 'disabled checked' : ''  }}></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->answered == 1)
                            <a href="{{ route('kuisioner.download', ['id' => $user->assign_id ]) }}" class="btn btn-xs btn-primary">Download PDF</a>
                            @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
            </table>
            <br>
            <button class="btn btn-success"> Simpan</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection
