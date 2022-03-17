@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Dosen</h3>
    </div>
    <div class="card-body">
        <a href="/tambah_dosen" class="btn btn-success btn-sm">Tambah Dosen</a>
        <a href="/data_dosen/trash" class="btn btn-danger btn-sm"> Sampah</a>
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
        <table class="table table-striped table-bordered table-sm" style="width:100%" id="datadosen">
            <thead>

                <tr>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
                <tbody>
                    @foreach($dosen as $dsn)
                    <tr>
                        <td>{{$dsn->nama}}</td>
                        <td>{{$dsn->NIP}}</td>
                        <td>{{ $dsn->prodi->prodi }}</td>
                        <td>{{ $dsn->roles->peran }}</td>
                        {{-- @if(isset($dsn->prodi_id))
                        <td>{{ $dsn->prodi->prodi }}</td>
                        @else
                        <td style="color:rgb(0, 64, 255)">Teknik</td>
                        @endif --}}
                        <td>
                        <a href="/edit_dosen/{{ $dsn->id }}" class="btn btn-info btn-sm">Edit</a>
                        @if ($dsn->roles_id == '2')
                        <a href="/hapus_dosen2/{{ $dsn->id }}/konfirmasi2" class="btn btn-danger btn-sm">Hapus</a>
                        @else
                        <a href="/hapus_dosen/{{ $dsn->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
        </table>
    </div>
</div>


@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
    $('#datadosen').DataTable();
    });
</script>
{{-- <script type="text/javascript">
    $(document).ready(function () {
        $('#datadosen').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('data dosen') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_dosen',
                    name: 'nama_dosen'
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
                    data:'roles.peran', 
                    name:'roles.peran'},
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
</script> --}}
@endpush
