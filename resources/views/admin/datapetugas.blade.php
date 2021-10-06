@extends('admin.main')

@section('container')
                    <h2 class="mt-4">Data Petugas Penomoran</h2>
      <div class="table-responsive">
        <a href="/tambah_petugas" class="">
                    <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right: 5px">Tambah Petugas</button>
        </a>
                    <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nama Petugas</th>
              <th scope="col">NIP</th>
              <th scope="col">E-mail Petugas</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($petugas as $ptgs )
              
            <tr>
              <td>{{ $ptgs->nama_petugas }}</td>
              <td>{{ $ptgs->NIP }}</td>
              <td>{{ $ptgs->email_petugas }}</td>
              <td>
                <a href="/edit_petugas/{{ $ptgs->id }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="/hapus_petugas/{{ $ptgs->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            
            @endforeach
          </tbody>
        </table>
      </div>

      @endsection
