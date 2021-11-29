@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Supervisor</h2>
    </div>
    <div class="card-body">
        @if (count($spv)==0)
        <a href="/tambah_supervisor" class="btn btn-success btn-sm">Tambah Supervisor
        </a>
        <br>
        <br>
        @endif
        {{-- <a href="/data_petugas/trash" class="btn btn-danger btn-sm">Sampah</a> --}}
        <table class="table table-striped table-bordered table-sm" id="dataspv" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Nama Supervisor</th>
                    <th scope="col">NIP</th>
                    <th scope="col">E-mail Supervisor</th>
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
        $('#dataspv').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('data spv') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_staff',
                    name: 'nama_staff'
                },
                {
                    data: 'NIP',
                    name: 'NIP'
                },
                {
                    data: 'email_staff',
                    name: 'email_staff'
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
