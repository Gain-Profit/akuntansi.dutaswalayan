@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Neraca</h1>
            <p>Di dalam akuntansi keuangan, Neraca atau laporan posisi keuangan (bahasa Inggris: balance sheet 
            atau statement of financial position) adalah bagian dari laporan keuangan yang memuat dan melaporkan 
            mengenai aktiva, kewajiban, dan ekuitas suatu perusahaan pada periode tertentu.<p>
            <a class="btn btn-primary btn-lg" href="{{ url('/neraca') }}" role="button">Lihat Neraca</a></p>
        </div>
        <div class="jumbotron">
            <h1>Laba Rugi</h1>
            <p>Laporan laba rugi (Inggris : Income Statement atau Profit and Loss Statement) 
            adalah bagian dari laporan keuangan suatu perusahaan yang dihasilkan 
            pada suatu periode akuntansi yang menjabarkan unsur-unsur pendapatan dan 
            beban perusahaan sehingga menghasilkan suatu laba (atau rugi) bersih.</p>
            <p><a class="btn btn-primary btn-lg" href="{{ url('/laba') }}" role="button">Lihat Laba Rugi</a></p>
        </div>
    </div>
@endsection
