@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Petugas Penomoran</h2>
    </div>
    <div class="card-body">
        @if (count($petugas)==0)
        <a href="/tambah_petugas" class="btn btn-success btn-sm">Tambah Petugas
        </a>
        <br>
        <br>
        @endif
        {{-- <a href="/data_petugas/trash" class="btn btn-danger btn-sm">Sampah</a> --}}
        <table class="table table-striped table-bordered table-sm" id="datapetugas" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Nama Petugas</th>
                    <th scope="col">NIP</th>
                    <th scope="col">E-mail Petugas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#datapetugas').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('data petugas') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'NIP',
                    name: 'NIP'
                },
                {
                    data: 'email',
                    name: 'email'
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
