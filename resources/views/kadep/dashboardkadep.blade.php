@extends('kadep.main')
@section('kadep')
<title>Dashboard</title>
@if ( Str::length(Auth::guard('ketua_departemen')->user()) >0 )
        <h1 class="h2">Selamat Datang, {{ Auth::guard('ketua_departemen')->user()->nama_kadep }} !</h1>
@endif
@endsection