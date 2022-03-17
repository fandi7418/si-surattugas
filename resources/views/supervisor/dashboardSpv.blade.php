@extends('supervisor.main')

@section('supervisor')
<title>Dashboard</title>
@if ( Str::length(Auth::guard('pengguna')->user()) >0 )
        <h1 class="h2">Selamat Datang, {{ Auth::guard('pengguna')->user()->nama }} di menu Supervisor !</h1>
@endif    
@endsection