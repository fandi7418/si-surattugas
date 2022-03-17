@extends('admin.main')

@section('container')
<h1 class="">Edit Profile</h1>

        @foreach ($admin as $adm)
        <form style="margin-right: 10px" method="post" action="/update_admin/{{ $adm->id }}">
            @csrf
            <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="colFormLabel" name="nama" value="{{ old('nama', $adm->nama) }}">
                    @error('nama')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="colFormLabel" name="email" value="{{ old('email', $adm->email) }}">
                    @error('email')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
                {{-- <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-5">
                        <input type="password" name="password" required minlength="6" class="form-control" id="inputPassword">
                        <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                    </div>
                </div> --}}
            <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ubah Password</a>
                </div>
            </div>
        @endforeach
        <!-- Form Pop Up Reset Password -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @foreach ($admin as $adm)
                <form action="/update_passwordadmin/{{ $adm->id }}" method="post">
                    @csrf
                    <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
                    <input type="password" required minlength="6" name="password" class="form-control" id="inputPassword">
                    <input type="checkbox" onclick="myFunction()"> Tampilkan Password
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
<script>
    function myFunction() {
        var x = document.getElementById("inputPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>


@endsection