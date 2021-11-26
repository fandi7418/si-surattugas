@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Staff yang dihapus sementara</h3>
    </div>
    <div class="card-body">
        <a href="/data_staff" style="float: right" class="btn btn-secondary btn-sm">Kembali</a>
        {{-- <a href="/data_staff/restore_semua" class="btn btn-success btn-sm">
                Restore Akun staff Semua
        </a>
        <a href="/hapus_staffpermanen/konfirmasisemua" class="btn btn-danger btn-sm">
                Hapus Permanen Semua
        </a> --}}
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
        <table class="table table-striped table-bordered table-sm" style="width:100%" id="datastaff">
            <thead>

                <tr>
                    <th scope="col">Nama Staff</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Status</th>
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
        $('#datastaff').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('data staff sementara') }}",
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
                    data: 'roles.peran',
                    name: 'roles.peran'
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
    $(".filter").on('change', function () {
        prodis = $("#filter-prodis").val()
        ajax.reload(null, false)

    })
    // $(document).ready(function () {
    //     fetch_data();
    //     function fetch_data(prodi = '')
    //     {
    //     $('#datastaff').DataTable({
    //         "oLanguage" : {
    //             "sProcessing": "<span>Memuat Data...</span>"  
    //         },
    //         serverside: true,
    //         processing: true,
    //         ajax: {
    //             url: "{{ route('data staff') }}",
    //             data: {prodi:prodi}
    //         },
    //         columns: [{
    //                 data: 'nama_staff',
    //                 name: 'nama_staff'
    //             },
    //             {
    //                 data: 'NIP',
    //                 name: 'NIP'
    //             },
    //             {
    //                 data: 'prodi',
    //                 name: 'prodi',
    //                 orderable: false
    //             },
    //             {
    //                 data: 'action',
    //                 name: 'action',
    //             },
    //         ],
    //         order: [
    //             [0, 'asc']
    //         ]
    //     });
    //     }
    //     $('#filter-prodis').change(function(){
    //         var id = $('#filter-prodis').val();

    //         $('#datadosen').DataTable().destroy();

    //         fetch_data(id);
    //     });
    // });

</script>
@endpush
