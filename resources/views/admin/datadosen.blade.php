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

<div class="table-responsive">
    <select class="btn btn-secondary dropdown-toggle btn-sm" href="#" id="filter" data-bs-toggle="dropdown"
        aria-expanded="false" style="float: right">Pilih Program Studi
        <ul class="dropdown-menu" aria-labelledby="dropdown03">
            <li>
                <option selected class="dropdown-item-dark" href="">Semua</option>
            </li>
            @foreach ($prodi as $prodis )
            <option value="{{ $prodis->id }}" {{ old('prodi_id') == $prodis->id ? 'selected' : null }}>
                {{ $prodis->prodi }}</option>
            @endforeach
        </ul>
    </select>

    <a href="/tambah_dosen" class="">
        <button type="submit" class="btn btn-success btn-sm" style="float: right; margin-right: 5px">
          Tambah Dosen</button>
    </a>
    <br>
    <br>
    <table class="table table-striped table-bordered table-sm" style="width:100%" id="datadosen">
        <thead>

            <tr>
                <th scope="col">Nama Dosen</th>
                <th scope="col">NIP</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Aksi</th>
            </tr>

          </thead>
        </table>
      </div>
    
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

       