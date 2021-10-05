@extends('admin.main')

@section('container')
@if ( Str::length(Auth::guard('admin')->user()) >0 )
<h1 class="mt-4">Dashboard  {{ Auth::guard('admin')->user()->nama_admin }}</h1>
@endif


@endsection
