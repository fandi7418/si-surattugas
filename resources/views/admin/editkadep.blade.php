@extends('admin.main')

@section('container')
<h1 class="">Edit Ketua Departemen</h1>
@foreach ($kadep as $kdp )
<form method="post" action="/update_kadep/{{ $kdp->id }}" style="margin-right: 10px">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" name="nama_kadep" value="{{ old('nama_kadep', $kdp->nama_kadep) }}"
                class="form-control @error('nama_kadep') is-invalid @enderror" id="colFormLabel">
            @error('nama_kadep')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-8">
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57"
                value="{{ old('NIP', $kdp->NIP) }}" name="NIP" class="form-control @error('NIP') is-invalid @enderror"
                id="colFormLabel" placeholder="Silahkan Masukkan NIP Anda">
            @error('NIP')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
        <div class="col-sm-8">
            <select class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id" id="prodi_id"
                aria-label="Default select example">
                <option disabled value="">Pilih Program Studi</option>
                @foreach ($prd as $prodis )
                <option value="{{ $prodis->id }}"
                    {{ old('prodi_id', $kdp->prodi_id) == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}
                </option>
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" name="email_kadep" value="{{ old('email_kadep', $kdp->email_kadep) }}"
                class="form-control @error('email_kadep') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan E-mail Anda">
            @error('email_kadep')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Simpan</button>


</form>
<a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Reset Password</a>
<a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ttdModal">Tanda Tangan</a>

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

<!-- Modal lihat tanda tangan -->
<div class="modal fade" id="ttdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Tanda Tangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="/update_ttdkadep/{{ $kdp->id }}" method="post">
                    @csrf
                    @foreach($kadep as $isi)
                    @if (is_null($isi->ttd_kadep))
                        <p style="color: red;">Anda Belum Menambahkan Tanda Tangan</p>
                    @else
                    <img src="/image/{{ $isi->ttd_kadep }}"  width="auto" height="200px" style="align:center">
                    @endif
                        @endforeach
                            <input class="form-control" type="file" id="formFile" name="ttd_kadep">
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
