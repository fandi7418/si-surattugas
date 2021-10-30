@extends('kadep.main')

@section('kadep')
<title>Profil</title>

    <h1 class="h2">Edit Profil</h1>
    <form enctype="multipart/form-data" method="post" action="/updateprofilkadep">
    @csrf
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="nama" value="{{ Auth::user()->nama_kadep }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="NIP" value="{{ Auth::user()->NIP }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-5">
                <select class="form-select" aria-label="Default select example" name="prodi">
                    <option disabled value="">Pilih Program Studi</option>
                    @foreach ($prodi as $prodis )
                    <option value="{{ $prodis->id }}" {{ old('prodi_id', Auth::user()->prodi_id) == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="email" value="{{ Auth::user()->email_kadep }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Update Tanda Tangan</label>
            <div class="col-sm-5">
                <input class="form-control" type="file" id="formFile" name="ttd">
                @if(is_null(Auth::user()->ttd_kadep))
                <small><a href="" data-toggle="modal" data-target="#ttdModal" style="display:none">Lihat Preview Tanda Tangan</a></small>
                @else
                <small><a href="" data-toggle="modal" data-target="#ttdModal">Lihat Tanda Tangan</a></small>
                @endif
            </div>
        </div>
        <br>
        <div class="col-sm-7">
        <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px">
            Simpan
        </button>
        </div>
    </form>
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
           <form action="/editpasswordkadep" method="post">
               @csrf
               <div class="mb-3">
               <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
               <input type="password" required minlength="6" name="password" class="form-control" id="myInput">
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

    <!-- Modal lihat tanda tangan -->
   <div class="modal fade" id="ttdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tanda Tangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($kadep as $isi)
                <img src="/image/{{ $isi->ttd_kadep }}" alt="" width="auto" height="200px" style="align:center">
                @endforeach
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