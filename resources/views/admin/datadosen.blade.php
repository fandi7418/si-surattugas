@extends('admin.main')

@section('container')
<h2 class="mt-4">Data Dosen</h2>
      <div class="table-responsive">
          <select class="btn btn-secondary dropdown-toggle btn-sm" href="#" id="filter" data-bs-toggle="dropdown" aria-expanded="false" style="float: right">Pilih Program Studi
            <ul class="dropdown-menu" aria-labelledby="dropdown03">
              <li><option selected class="dropdown-item-dark" href="">Semua</option></li>
              <li><option value="" class="dropdown-item-dark" href="#"></option></li>
              @foreach ($prodi as $prodis )
              <option value="{{ $prodis->id }}" {{ old('prodi_id') == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
              @endforeach
            </ul>
          </select>
          <!-- {{-- <form action=""></form> --}} -->
        <a href="/tambah_dosen" class="">
        <button type="submit"  class="btn btn-success btn-sm" style="float: right; margin-right: 5px">Tambah Dosen</button>
      </a>
      <br>
      <br>
        <table class="table table-striped table-bordered table-sm" id="datadosen">
          <thead>
            <tr>
              <th scope="col" style="width: auto">Nama Dosen</th>
              <th scope="col" style="width: auto">NIP</th>
              <th scope="col" style="width: auto">Program Studi</th>
              <th scope="col" style="width: 100px">Aksi</th>
            </tr>
          </thead>
          <!-- {{-- <tbody>
            @foreach($dosen as $dsn)
            <tr>
              <td>{{ $dsn->nama_dosen }}</td>
              <td>{{ $dsn->NIP }}</td>
              <td>{{ $dsn->prodi->prodi }}</td>
              <td>
                  <a href="/edit_dosen/{{ $dsn->id }}" class="btn btn-primary btn-sm">Edit</a>
                  <a href="/hapus_dosen/{{ $dsn->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
            </td>
            </tr>
            @endforeach
          </tbody> --}} -->
        </table>
      </div>
      <!-- {{-- <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        {{ $dosen->links() }}
        </ul>
    </nav> --}} -->
    
    @endsection
    @push('scripts')
        <script>
              $(document).ready(function() {
                  $('#datadosen').DataTable({
                      processing : true,
                      serverside : true,
                      ajax : {
                        url: "{{ route('data dosen') }}",
                        type: 'GET'
                      },
                      columns:[
                        {data:'nama_dosen', name:'nama_dosen'},
                        {data:'NIP', name:'NIP'},
                        {data:'prodi.prodi', name:'prodi.prodi'},
                        {
                            data: 'action', 
                            name: 'action', 
                            orderable: true, 
                            searchable: true
                        },
                      ],
                      order: [[0,'asc']]
                  });
              } );
          </script>
      @endpush
