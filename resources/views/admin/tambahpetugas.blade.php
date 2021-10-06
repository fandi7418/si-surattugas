@extends('admin.main')

@section('container')

                    <h1 class="">Tambah Petugas Penomoran</h1>
                    <form method="post" action="/tambah_petugas" style="margin-right: 10px">
                        @csrf
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                    <input type="text" required name="nama" class="form-control" id="colFormLabel" placeholder="Silahkan Masukkan Nama Anda">
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-8">
                    <input type="text" required onkeypress="return event.charCode >= 48 && event.charCode <=57" name="NIP" class="form-control" id="colFormLabel" placeholder="Silahkan Masukkan NIP Anda">
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" required name="email" class="form-control" id="colFormLabel" placeholder="Silahkan Masukkan E-mail Anda">
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-5">
                    <input type="password" required name="password" class="form-control" minlength="6" id="inputPassword" placeholder="Silahkan Masukkan Password Anda">
                    <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-5">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </div>
            </div>
            </form> 
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