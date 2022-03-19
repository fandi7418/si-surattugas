@extends('admin.main')

@section('container')
@if ( Str::length(Auth::guard('pengguna')->user()) >0 )
<h1 class="mt-4">Dashboard  {{ Auth::guard('pengguna')->user()->nama }}</h1>
@endif



@endsection
@push('scripts')
<script>
    swal("Hello world!");
</script>