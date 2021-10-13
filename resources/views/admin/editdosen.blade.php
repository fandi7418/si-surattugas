@extends('admin.main')

@section('container')

<h1 class="">Edit Dosen</h1>
        @foreach ($dosen as $dsn )

        <form method="post" action="/update_dosen/{{ $dsn->id }}" style="margin-right: 10px">
            @csrf
            <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" name="nama" class="form-control" id="colFormLabel" value="{{ $dsn->nama_dosen }}">
                </div>
            </div>
            <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-8">
                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="NIP"
                        class="form-control" id="colFormLabel" value="{{ $dsn->NIP }}">
                </div>
            </div>
            <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-8">
                    <select class="form-select" name="prodi" aria-label="Default select example">
                        <option selected>{{ $dsn->prodi_dosen }}</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Arsitektur">Teknik Arsitektur</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                        <option value="Teknik Perencanaan Wilayah dan Kota">Teknik Perencanaan Wilayah dan Kota</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Perkapalan">Teknik Perkapalan</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                        <option value="Teknik Geologi">Teknik Geologi</option>
                        <option value="Teknik Geodesi">Teknik Geodesi</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" name="email" class="form-control" id="colFormLabel" value="{{ $dsn->email_dosen }}">
                </div>
            </div>
            {{-- <div class="form-group row mt-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-5">
                    <input type="password" name="password" class="form-control" value="{{ $dsn->password }}" id="inputPassword">
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
                        @foreach ($dosen as $dsn)
                        <form action="/update_passworddosen/{{ $dsn->id }}" method="post">
                            @csrf
                            <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
                            <input type="password" required minlength="6" name="password" class="form-control" id="recipient-name">
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
                        var x = document.getElementById("recipient-name");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>

@endsection