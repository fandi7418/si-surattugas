@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Wakil Dekan</h3>
    </div>
    <div class="card-body">
        <a href="/data_wakildekan" style="float: right" class="btn btn-secondary btn-sm">kembali</a>
        <br>
        <br>
        <table class="table table-striped table-bordered table-sm" style="width:100%" id="datawd">
            <thead>
                    <tr>
                        <th scope="col">Nama Wakil Dekan</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wd as $wakil)
                    <tr>
                        <td>{{$wakil->nama_wd}}</td>
                        <td>{{$wakil->NIP}}</td>
                        <td>{{ $wakil->email_wd }}</td>
                        <td>
                        <a href="/data_wakildekan/restore/{{ $wakil->id }}" class="btn btn-success btn-sm">Restore</a>
                        <a href="/hapus_wakildekanpermanen/{{ $wakil->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus Permanen</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
      $('#datawd').DataTable();
    });
</script>
@endpush
