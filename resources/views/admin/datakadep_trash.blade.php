@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kadep yang dihapus sementara</h3>
    </div>
    <div class="card-body">
        <a href="/data_kadep/restore_semua" class="btn btn-success btn-sm">Restore Akun Kadep Semua
        </a>
        <a href="hapus_kadeppermanen/konfirmasi" class="btn btn-danger btn-sm">Hapus Permanen Semua
        </a>
        {{-- <select class="btn btn-secondary btn-sm filter" style="float: right" href="#" id="filter-prodis"
            aria-expanded="false" style="">Pilih Program Studi
            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                <li>
                    <option selected class="dropdown-item-dark" href="">Semua</option>
                </li>
                @foreach ($prodi as $prodis )
                <option value="{{ $prodis->id }}">
                    {{ $prodis->prodi }}</option>
                @endforeach
            </ul>
        </select> --}}
        <br>
        <br>
        <table class="table table-striped table-bordered table-sm" style="width:100%" id="datakadep">
            <thead>
                <tr>
                    <th scope="col">Nama Kadep</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#datakadep').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('data kadep sementara') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_kadep',
                    name: 'nama_kadep'
                },
                {
                    data: 'NIP',
                    name: 'NIP'
                },
                {
                    data: 'prodi.prodi',
                    name: 'prodi.prodi'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
    });
</script>
@endpush
