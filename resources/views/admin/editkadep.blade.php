@extends('admin.main')

@section('container')
<h1 class="">Edit Ketua Departemen</h1>
@foreach ($kadep as $kdp )
<form method="post" action="/update_kadep/{{ $kdp->id }}" style="margin-right: 10px">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" name="nama_kadep" class="form-control" id="colFormLabel" value="{{ $kdp->nama_kadep }}">
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-8">
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="NIP"
                class="form-control" id="colFormLabel" value="{{ $kdp->NIP }}">
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
        <div class="col-sm-8">
            <select class="form-select" name="prodi_id" id="prodi_id" aria-label="Default select example">
                <option disabled value>Pilih Program Studi</option>
                <option value="{{ $kdp->prodi_id }}">{{ $kdp->prodi->prodi }}</option>
                @foreach ($prd as $prodis )
                <option value="{{ $prodis->id }}">{{ $prodis->prodi }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" name="email_kadep" class="form-control" id="colFormLabel" value="{{ $kdp->email_kadep }}">
        </div>
    </div>
    {{-- <div class="form-group row mt-4">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-5">
                                <input type="password" class="form-control" id="inputPassword" >
                                <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                                    </div>
                                    </div> --}}
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Reset Password</a>
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
                @foreach ($kadep as $kdp)
                <form action="/update_passwordkadep/{{ $kdp->id }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
                        <input type="password" required minlength="6" name="password" class="form-control"
                            id="inputPassword">
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