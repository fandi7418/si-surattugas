@extends('admin.main')

@section('container')

<h1 class="">Edit Staff</h1>
@foreach ($staff as $stf )
    
        <form method="post" action="{{ url('update_staff/'. $stf->id) }}" style="margin-right: 10px">
            @csrf
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="{{ old('nama_staff', $stf->nama_staff) }}" name="nama_staff"
                            class="form-control @error('nama_staff') is-invalid @enderror" id="colFormLabel" placeholder="Silahkan Masukkan nama Anda">
                                @error('nama_staff')
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
                            onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{ old('NIP', $stf->NIP) }}" name="NIP"
                            class="form-control @error('NIP') is-invalid @enderror" id="colFormLabel" placeholder="Silahkan Masukkan NIP Anda">
                                @error('NIP')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-8">
                        <select class="form-select @error('jabatan') is-invalid @enderror" onchange="getJabatan()" name="jabatan" id="jabatan"
                        aria-label="Default select example">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatan as $jbtn )
                            <option value="{{ $jbtn->id }}" {{ old('jabatan_id', $stf->jabatan_id) == $jbtn->id ? 'selected' : null }}>{{ $jbtn->nama_jabatan }}</option>
                            @endforeach
                        </select>
                                @error('jabatan')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Pangkat/Gol</label>
                    <div class="col-sm-8">
                        <select class="form-select @error('pangkat') is-invalid @enderror" name="pangkat" id="pangkat"
                            aria-label="Default select example">
                                <option value="">Pilih Pangkat/Gol</option>
                                @foreach ($golongan as $gol )
                                <option value="{{ $gol->id }}" {{ old('golongan_id', $stf->golongan_id) == $gol->id ? 'selected' : null }}>{{ $gol->nama_golongan }}</option>
                                @endforeach
                    </select>
                                @error('pangkat')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                    </div>
                </div>
                @if ($stf->roles_id =='5')
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-8">
                        <select class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id" id="prodi_id" aria-label="Default select example">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($prd as $prodis )
                            <option value="{{ $prodis->id }}" {{ old('prodi_id', $stf->prodi_id) == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                @endif
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email_staff" value="{{ old('email_staff', $stf->email_staff) }}" class="form-control @error('email_staff') is-invalid @enderror" id="colFormLabel"
                            placeholder="Silahkan Masukkan E-mail Anda">
                                @error('email_staff')
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
            <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ubah Password</a>
            </div>
            </div>
            @endforeach
            <!-- Form Pop Up Reset Password  test-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        @foreach ($staff as $stf)
                        <form action="/update_passwordstaff/{{ $stf->id }}" method="post">
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