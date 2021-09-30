@extends('admin.main')

@section('container')
                    <h2 class="mt-4">Data Admin</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nama Admin</th>
              <th scope="col">NIP</th>
              <th scope="col">E-mail Admin</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
            <tbody>
              @foreach($admin as $adm)
                
              <tr>
                <td>{{ $adm->nama_admin }}</td>
                <td>{{ $adm->NIP }}</td>
                <td>{{ $adm->email_admin }}</td>
                <td><a href="/edit_admin/{{ $adm->id }}" class="btn btn-primary btn-sm">Edit</a></td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div>

      
      @endsection