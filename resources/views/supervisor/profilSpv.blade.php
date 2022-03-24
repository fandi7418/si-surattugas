@extends('supervisor.main')

@section('supervisor')
<title>Profil</title>

    <h1 class="h2">Edit Profil</h1>
    <br>
    @foreach ($staff as $isi)
    <form method="post" action="/updateprofilSpv/{{ $isi->id }}">
        @csrf
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input required type="text" class="form-control" placeholder=" " name="nama" value="{{ $isi->nama }}">
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
            <label class="col-sm-2 col-form-label">Bagian</label>
            <div class="col-sm-5">
                <input readonly type="text" class="form-control" placeholder=" " name="NIP" value="{{ $isi->bagianstaff->bagian }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-5">
                <select class="form-select @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan"
                aria-label="Default select example">
                    <option value="">Pilih Jabatan</option>
                    @foreach ($jabatan as $jbtn )
                    <option value="{{ $jbtn->id }}" {{ old('jabatan_id', $isi->jabatan_id) == $jbtn->id ? 'selected' : null }}>{{ $jbtn->nama_jabatan }}</option>
                    @endforeach
                </select>
                @error('jabatan')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
            <div class="col-sm-5">
                <select class="form-select @error('pangkat') is-invalid @enderror" name="pangkat" id="pangkat"
                    aria-label="Default select example">
                        <option value="">Pilih Pangkat/Gol</option>
                        @foreach ($golongan as $gol )
                        <option value="{{ $gol->id }}" {{ old('golongan_id', $isi->golongan_id) == $gol->id ? 'selected' : null }}>{{ $gol->nama_golongan }}</option>
                        @endforeach
                </select>
                @error('pangkat')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-5">
                <input type="text" class="form-control @error('email_staff') is-invalid @enderror" placeholder=" " name="email_staff" value="{{ $isi->email }}">
                    @error('email_staff')
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
    <!-- <a class="btn btn-secondary" style="float: right; margin-right: 10px" data-toggle="modal" data-target="#ttdModal">
        Tanda Tangan
    </a> -->

    <!-- Modal tanda tangan -->
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
                    @if(is_null(Auth::user()->ttd))
                        <p style="color:red; text-align: center">Anda belum upload tanda tangan</p>
                        <br>
                    @else
                        @foreach($staff as $isi)
                            <img src="/image/{{ $isi->ttd }}" alt="" width="auto" height="200px" style="align:center">
                        @endforeach
                    @endif
                    <form enctype="multipart/form-data" method="post" action="/uploadTTDSpv">
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


    <!-- Form Pop Up Reset Password -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel" >Ubah Password</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <form action="/editpasswordSpv" method="post">
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