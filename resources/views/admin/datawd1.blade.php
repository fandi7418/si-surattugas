@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Wakil Dekan</h3>
    </div>
    <div class="card-body">
        @if (count($wd)==0)
        <a href="/tambah_wakildekan" class="btn btn-success btn-sm">Tambah Wakil Dekan</a>
        <br>
        <br>
        @endif
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
                        <td>{{$wakil->nama_dosen}}</td>
                        <td>{{$wakil->NIP}}</td>
                        <td>{{ $wakil->email_dosen }}</td>
                        <td>
                        <a href="/edit_dosen/{{ $wakil->id }}" class="btn btn-info btn-sm">Edit</a>
                        <a href="/hapus_wakildekan/{{ $wakil->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
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
