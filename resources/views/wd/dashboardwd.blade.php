@extends('wd.main')

@section('wd')
<title>Dashboard</title>
@if ( Str::length(Auth::guard('dosen')->user()) >0 )
        <h1 class="h2">Selamat Datang, {{ Auth::guard('dosen')->user()->nama_dosen }} !</h1>
@endif
@endsection