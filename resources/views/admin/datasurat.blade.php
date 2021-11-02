@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Surat</h2>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-sm" id="datasurat" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">No. Surat</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

{{-- <tbody>
                                @foreach ($surat as $srt )
                                    
                                <tr>
                                <td>{{ $srt->no_surat }}</td>
<td>{{ $srt->judul }}</td>
<td>{{ $srt->nama_dosen }}</td>
<td>{{ $srt->prodi->prodi }}</td>
<td>{{ \Carbon\Carbon::parse($srt->created_at)->isoFormat('D MMMM Y')}}</td>
<td>{{ $srt->status->status }}</td>
<td>
    <a href="/surat/{{ $srt->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
    <a href="/hapus_surat/{{ $srt->id }}/konfirmasiadmin" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
@endforeach
</tbody> --}}
@push('scripts')
<script>
    $(document).ready(function () {
        $('#datasurat').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('data surat') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'no_surat',
                    name: 'no_surat'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'nama_dosen',
                    name: 'nama_dosen'
                },
                {
                    data: 'prodi.prodi',
                    name: 'prodi.prodi'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'status.status',
                    name: 'status.status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
    });

</script>
@endpush
