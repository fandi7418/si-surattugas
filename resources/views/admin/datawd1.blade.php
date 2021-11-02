@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Wakil Dekan</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm">
            <a href="/tambah_wakildekan" class="">
                <button type="submit" class="btn btn-success btn-sm" style="">Tambah
                    Wakil
                    Dekan</button>
            </a>
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
            </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#datawd').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('data wakil dekan') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_wd',
                    name: 'nama_wd'
                },
                {
                    data: 'NIP',
                    name: 'NIP'
                },
                {
                    data: 'email_wd',
                    name: 'email_wd'
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
