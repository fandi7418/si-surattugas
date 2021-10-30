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
                    {{-- <a href="" class="btn btn-secondary btn-sm btn-editps" data-bs-toggle="modal" data-id="{{ $adm->id }}" data-bs-target="#editps">Reset Password</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
      {{ $adm->links() }}
      </ul>
    </nav>

{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
  <!-- Form Pop Up Reset Password -->
  {{-- <div class="modal fade" id="editps" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        @foreach ($admin as $adm)
          <form action="/update_passwordadmin/{{ $adm->id }}" method="post">
            @endforeach
              @csrf
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
                <input type="password" required minlength="6" name="password" class="form-control" id="recipient-name">
                <input type="checkbox" onclick="myFunction()"> Tampilkan Password
              </div>
            </form>
            
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div> --}}

  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div> --}}
    <!-- Form End Pop Up Reset Password -->


  <script>
    function myFunction() {
        var x = document.getElementById("recipient-name");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

      @endsection