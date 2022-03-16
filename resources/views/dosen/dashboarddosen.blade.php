@extends('dosen.main')

@section('dosen')
<title>Dashboard</title>
@if ( Str::length(Auth::guard('pengguna')->user()) >0 )
        <h1 class="h2">Selamat Datang, {{ Auth::guard('pengguna')->user()->nama }} !</h1>
@endif    
@endsection