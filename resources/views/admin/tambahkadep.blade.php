@extends('admin.main')

@section('container')

                    <h1 class="">Tambah Kepala Departemen</h1>
                    <form style="margin-right: 10px">
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="colFormLabel" placeholder="Silahkan Masukkan Nama Anda">
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="colFormLabel" placeholder="Silahkan Masukkan NIP Anda">
                        </div>
                        </div>
                        <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Program Studi</option>
                                    <option value="1">Teknik Sipil</option>
                                    <option value="2">Teknik Arsitektur</option>
                                    <option value="3">Teknik Kimia</option>
                                    <option value="4">Teknik Perencanaan Wilayah dan Kota</option>
                                    <option value="5">Teknik Mesin</option>
                                    <option value="6">Teknik Elektro</option>
                                    <option value="7">Teknik Perkapalan</option>
                                    <option value="8">Teknik Industri</option>
                                    <option value="9">Teknik Lingkungan</option>
                                    <option value="10">Teknik Geologi</option>
                                    <option value="11">Teknik Geodesi</option>
                                    <option value="12">Teknik Komputer</option>
                                </select>
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" id="colFormLabel" placeholder="Silahkan Masukkan E-mail Anda">
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-5">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Silahkan Masukkan Password Anda">
                    <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-5">
                    <button type="button" class="btn btn-primary">Simpan</button>
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