@extends('admin.main')

@section('container')
                    <h2 class="mt-4">Data Wakil Dekan Teknik</h2>
      <div class="table-responsive">

                    <table class="table table-striped table-sm">
                      <a href="/tambah_wakildekan" class="">
                        <button type="submit"  class="btn btn-success btn-sm" style="float: right; margin-right: 5px">Tambah Wakil Dekan</button>
                      </a>
          <thead>
            <tr>
              <th scope="col">Nama Wakil Dekan</th>
              <th scope="col">NIP</th>
              <th scope="col">Email</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($wakildekan as $wd1 )
              

            <tr>
              <td>{{ $wd1->nama_wd }}</td>
              <td>{{ $wd1->NIP }}</td>
              <td>{{ $wd1->email_wd }}</td>
              <td>
                <a href="/edit_wakildekan/{{ $wd1->id }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="/hapus_wakildekan/{{ $wd1->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
              
            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        
@endsection