@extends('admin.main')

@section('container')

<h1 class="">Tambah Dosen</h1>
                    <form style="margin-right: 10px" method="POST" action="/tambah_dosen">
                        @csrf
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_dosen" value="{{ old('nama_dosen') }}" class="form-control @error('nama_dosen') is-invalid @enderror" id="colFormLabel"
                                    placeholder="Silahkan Masukkan Nama Anda">
                                        @error('nama_dosen')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{ old('NIP') }}" name="NIP"
                                    class="form-control @error('NIP') is-invalid @enderror" id="colFormLabel" placeholder="Silahkan Masukkan NIP Anda">
                                        @error('NIP')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Pangkat/Gol</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    value="{{ old('pangkat') }}" name="pangkat"
                                    class="form-control @error('pangkat') is-invalid @enderror" id="colFormLabel" placeholder="Silahkan Masukkan Pangkat Anda">
                                        @error('pangkat')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-8">
                                <input type="text"
                                value="{{ old('jabatan') }}" name="jabatan"
                                    class="form-control @error('jabatan') is-invalid @enderror" id="colFormLabel" placeholder="Silahkan Masukkan Jabatan Anda">
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="prodi_id" id="prodi_id" aria-label="Default select example">
                                    <option disabled value>Pilih Program Studi</option>
                                    @foreach ($prd as $prodis )
                                    <option value="{{ $prodis->id }}">{{ $prodis->prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email_dosen" value="{{ old('email_dosen') }}" class="form-control @error('email_dosen') is-invalid @enderror" id="colFormLabel"
                                    placeholder="Silahkan Masukkan E-mail Anda">
                                        @error('email_dosen')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-5">
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                    placeholder="Silahkan Masukkan Password Anda">
                                        @error('password')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
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