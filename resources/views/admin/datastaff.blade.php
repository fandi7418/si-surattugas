@extends('admin.main')

@section('container')
<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Staff</h3>
    </div>
    <div class="card-body">
        <a href="/tambah_staff" class="btn btn-success btn-sm">Tambah Staff</a>
        <a href="/data_staff/trash" class="btn btn-danger btn-sm"> Sampah</a>
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
                    <th scope="col">Prodi/Fakultas</th>
                    <th scope="col">Aksi</th>
                </tr>

            </thead>
            <tbody>
                @foreach($staff as $stf)
                <tr>
                    <td>{{$stf->nama}}</td>
                    <td>{{$stf->NIP}}</td>
                    <td>{{ $stf->roles->peran }}</td>
                    @if(isset($stf->prodi_id))
                    <td>{{ $stf->prodi->prodi }}</td>
                    @else
                    <td style="color:rgb(0, 64, 255)">Teknik</td>
                    @endif
                    <td>
                    <a href="/edit_staff/{{ $stf->id }}" class="btn btn-info btn-sm">Edit</a>
                    <a href="/hapus_staff/{{ $stf->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
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
      $('#datastaff').DataTable();
    });
    // $(document).ready(function () {
    //     $('#datastaff').DataTable({
    //         processing: true,
    //         serverside: true,
    //         ajax: {
    //             url: "{{ route('data staff') }}",
    //             type: 'GET'
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
    //                 data:'roles.peran', 
    //                 name:'roles.peran'
    //             },
    //             {
    //                 data: 'action',
    //                 name: 'action',
    //                 orderable: false,
    //                 searchable: false
    //             },
    //         ],
    //         order: [
    //             [0, 'asc']
    //         ]
    //     });
    // });

</script>
@endpush
