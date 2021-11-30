@extends('supervisor.main')

@section('supervisor')
<title>Dashboard</title>
@if ( Str::length(Auth::guard('staff')->user()) >0 )
        <h1 class="h2">Selamat Datang, {{ Auth::guard('staff')->user()->nama_staff }} di menu Supervisor !</h1>
@endif    
@endsection