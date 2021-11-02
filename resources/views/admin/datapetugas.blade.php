@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Petugas Penomoran</h2>
    </div>
    <div class="card-body">
        <a href="/tambah_petugas" class="">
            <button type="button" class="btn btn-success btn-sm" style="">Tambah
                Petugas</button>
        </a>
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
                url: "{{ route('data petugas') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_petugas',
                    name: 'nama_petugas'
                },
                {
                    data: 'NIP',
                    name: 'NIP'
                },
                {
                    data: 'email_petugas',
                    name: 'email_petugas'
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
