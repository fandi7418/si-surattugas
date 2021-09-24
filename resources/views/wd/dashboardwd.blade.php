@extends('wd.main')

@section('wd')
<title>Dashboard</title>
@if ( Str::length(Auth::guard('wakildekan')->user()) >0 )
        <h1 class="h2">Selamat Datang, {{ Auth::guard('wakildekan')->user()->nama_wd }} !</h1>
@endif
@endsection