@extends('admin.main')

@section('container')

                    <h1 class="">Tambah Ketua Departemen</h1>
                    <form method="post" action="/tambah_kadep" style="margin-right: 10px">
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
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-8">
                                    <select required class="form-select" name="prodi" aria-label="Default select example">
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
                    <input type="email" required name="email" class="form-control" id="colFormLabel" placeholder="Silahkan Masukkan E-mail Anda">
                        </div>
                        </div>
                    <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-5">
                    <input type="password" required name="password" minlength="6" class="form-control" id="inputPassword" placeholder="Silahkan Masukkan Password Anda">
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