@extends('layouts.app')

@section('content')
    <div class="container bg-white p-5">
        <p class="text-center text-4xl mb-4">🙏🏼</p>
        <h5 class="text-center font-bold mb-2">JAWABAN TELAH TERSIMPAN</h5>
        <h5 class="text-center font-bold mb-10">TERIMAKASIH TELAH MENGISI KUESIONER PENELITIAN INI</h5>

        <p class="text-center text-xs">Halaman ini akan logout otomatis dalam 2 detik.</p>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            setTimeout(function() {
                document.getElementById('logout-form').submit();
            }, 2000);
        })
    </script>
@endsection