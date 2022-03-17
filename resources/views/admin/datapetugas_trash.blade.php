@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Petugas Penomoran</h2>
    </div>
    <div class="card-body">
        <a href="/data_petugas" class="btn btn-secondary btn-sm">kembali</a>
        <br>
        <br>
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
                url: "{{ route('data petugas sementara') }}",
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
