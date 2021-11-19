@extends('wd.main')

@section('wd')
<title>Profil</title>

<h1 class="h2">Edit Profil</h1>
<br>
@foreach ($wd as $isi)
<form enctype="multipart/form-data" method="post" action="/updateprofilwd/{{ $isi->id }}">
    @csrf
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" placeholder=" " name="nama" value="{{ $isi->nama_wd }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-5">
            <input type="text" class="form-control @error('NIP') is-invalid @enderror" placeholder=" " name="NIP" value="{{ $isi->NIP }}">
            @error('NIP')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-5">
            <input type="text" class="form-control @error('email_wd') is-invalid @enderror" placeholder=" " name="email_wd" value="{{ $isi->email_wd }}">
            @error('email_wd')
                <div id="validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-sm-7">
    <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px">
        Simpan
    </button>
    </div>
</form>
@endforeach
<a class="btn btn-secondary" style="float: right; margin-right: 10px" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Ubah Password?
</a>
<a class="btn btn-secondary" style="float: right; margin-right: 10px" data-toggle="modal" data-target="#ttdModal">
    Tanda Tangan
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
        <form action="/editpasswordwd" method="post">
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
        </form>
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
            @if(is_null(Auth::user()->ttd_wd))
                <p style="color:red; text-align: center">Anda belum upload tanda tangan</p>
                <br>
            @else
                <img src="/image/{{ Auth::user()->ttd_wd }}" alt="" width="auto" height="200px" style="align:center">
            @endif
            <form enctype="multipart/form-data" method="post" action="/uploadTTD">
                @csrf
                <div class="form-group row">
                    <label class="col-form-label">Update Tanda Tangan</label>
                    <div class="col">
                        <input class="form-control" type="file" id="formFile" name="ttd">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="float:right; margin-top:10px">Simpan</button>
            </form>
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