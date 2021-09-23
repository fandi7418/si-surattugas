@extends('petugas.main')

@section('petugas')
<title>Dashboard</title>
@if ( Str::length(Auth::guard('petugas_penomoran')->user()) >0 )
        <h1 class="h2">Selamat Datang, {{ Auth::guard('petugas_penomoran')->user()->nama_petugas }} !</h1>
@endif
@endsection