@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Surat Sementara</h2>
    </div>
    <div class="card-body">
        <a href="/data_surat" style="float: right" class="btn btn-secondary btn-sm">Kembali</a>
        <br>
        <br>
        <table class="table table-striped table-bordered table-sm" id="datasurat" style="width: 100%">
            <thead>
                <tr style="text-align:center">
                    <th scope="col">No. Surat</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col" style="display: none">id</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surat as $srt )
                <tr>
                    <td>{{ $srt->no_surat }}</td>
                    <td>{{ $srt->judul }}</td>
                    <td>{{ $srt->nama }}</td>
                    <td>{{ $srt->prodi->prodi }}</td>
                    <td>{{ \Carbon\Carbon::parse($srt->created_at)->isoFormat('D MMMM Y')}}</td>
                    <td style="display: none">{{ $srt->id }}</td>
                    <td>
                        <a href="/data_surat/restore/{{ $srt->id }}" class="btn btn-success btn-sm">Restore</a>
                        <a href="/hapus_suratpermanen/{{ $srt->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus Permanen</a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection
</tbody>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#datasurat').DataTable({
            order: [
                [5, 'desc']
            ]
        });
    });
</script>
@endpush
