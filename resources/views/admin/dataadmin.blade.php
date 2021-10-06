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
                <td>
                    
                    <a href="/edit_admin/{{ $adm->id }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Reset</a>
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> --}}
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        @foreach ($admin as $adm)
          <form action="/update_password/{{ $adm->id }}" method="post">
              @csrf
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
              <input type="password" required minlength="6" name="password" class="form-control" id="recipient-name">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</form>
  @endforeach
      @endsection