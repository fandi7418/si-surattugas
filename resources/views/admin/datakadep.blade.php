@extends('admin.main')

@section('container')
<br>
<div class="card">
  <div class="card-header">
    <h2 class="card-title">Data Ketua Departemen</h2>
  </div>
  <div class="card-body">
    <a href="/tambah_kadep" class="btn btn-success btn-sm">Tambah Kadep</a>
    {{-- <a href="/data_kadep/trash" class="btn btn-danger btn-sm">Sampah</a> --}}
    <br><br>
    <table class="table table-striped table-bordered table-sm" id="datakadep" style="width: 100%">
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
          {{-- <tbody>
            @foreach($kadep as $kdp)
            <tr>
              <td>{{ $kdp->nama_kadep }}</td>
              <td>{{ $kdp->NIP }}</td>
              <td>{{ $kdp->prodi->prodi }}</td>
              <td>  <a href="/edit_kadep/{{ $kdp->id }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/hapus_kadep/{{ $kdp->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody> --}}
        
        
@endsection

@push('scripts')
        <script>
              $(document).ready(function() {
                  $('#datakadep').DataTable({
                      processing : true,
                      serverside : true,
                      ajax : {
                        url: "{{ route('data kadep') }}",
                        type: 'GET'
                      },
                      columns:[
                        {data:'nama_dosen', name:'nama_dosen'},
                        {data:'NIP', name:'NIP'},
                        {data:'prodi.prodi', name:'prodi.prodi'},
                        {
                            data: 'action', 
                            name: 'action', 
                            orderable: false, 
                            searchable: false
                        },
                      ],
                      order: [[0,'asc']]
                  });
              } );
          </script>
      @endpush