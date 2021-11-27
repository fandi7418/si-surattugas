@extends('supervisor.main')

@section('supervisor')
<title>Profil</title>

    <h1 class="h2">Edit Profil</h1>
    <br>
    @foreach ($dosen as $isi)
    <form method="post" action="/updateprofildosen/{{ $isi->id }}">
        @csrf
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input required type="text" class="form-control" placeholder=" " name="nama" value="{{ $isi->nama_dosen }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-5">
                <input type="text" class="form-control @error('NIP') is-invalid @enderror" placeholder=" " name="NIP" value="{{ $isi->NIP }}">
                    @error('NIP')
                        <div class="alert alert-danger alert-dismissible fade show mt-3">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-5">
            <input readonly type="text" class="form-control" placeholder=" " value="{{ $isi->prodi->prodi }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
            <div class="col-sm-5">
                <input required type="text" class="form-control" placeholder=" " name="pangkat" value="{{ $isi->pangkat }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-5">
                <input required type="text" class="form-control" placeholder=" " name="jabatan" value="{{ $isi->jabatan }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-5">
                <input type="text" class="form-control @error('email_dosen') is-invalid @enderror" placeholder=" " name="email_dosen" value="{{ $isi->email_dosen }}">
                    @error('email_dosen')
                        <div class="alert alert-danger alert-dismissible fade show mt-3">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
            </div>
        </div>
        <div class="col-sm-7">
        <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px">
            Simpan
        </button>
    </form>
    @endforeach
</div>
    <a class="btn btn-secondary" style="float: right; margin-right: 10px" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ubah Password?
    </a>
    <!-- Form Pop Up Reset Password -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel" >Ubah Password</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <form action="/editpassworddosen" method="post">
                @csrf
                <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
                <input type="password" required minlength="6" name="password" class="form-control" id="myInput">
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
   </div>

    <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        } 
    </script>
@endsection