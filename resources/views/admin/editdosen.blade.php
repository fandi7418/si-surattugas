@extends('admin.main')

@section('container')

<h1 class="">Edit Dosen</h1>
@foreach ($dosen as $dsn )
    
        <form method="post" action="{{ url('update_dosen/'. $dsn->id) }}" style="margin-right: 10px">
            @csrf
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text"
                            value="{{ old('nama_dosen', $dsn->nama_dosen) }}" name="nama_dosen"
                            class="form-control @error('nama_dosen') is-invalid @enderror" id="colFormLabel" placeholder="Silahkan Masukkan nama Anda">
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
                            onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{ old('NIP', $dsn->NIP) }}" name="NIP"
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
                            <option value="{{ $jbtn->id }}" {{ old('jabatan_id', $dsn->jabatan_id) == $jbtn->id ? 'selected' : null }}>{{ $jbtn->nama_jabatan }}</option>
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
                                <option value="{{ $gol->id }}" {{ old('golongan_id', $dsn->golongan_id) == $gol->id ? 'selected' : null }}>{{ $gol->nama_golongan }}</option>
                                @endforeach
                        </select>
                                @error('pangkat')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                    </div>
                </div>
                @if ($dsn->roles_id == '2')
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-8">
                        <select  class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id" id="prodi_id" aria-label="Default select example">
                            <option disabled value="">Pilih Program Studi</option>
                            @foreach ($prd as $prodis )
                            <option value="{{ $prodis->id }}" {{ old('prodi_id', $dsn->prodi_id) == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                @elseif ($dsn->roles_id == '3')
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-8">
                        <select  class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id" id="prodi_id" aria-label="Default select example">
                            <option disabled value="">Pilih Program Studi</option>
                            @foreach ($prd as $prodis )
                            <option value="{{ $prodis->id }}" {{ old('prodi_id', $dsn->prodi_id) == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                @else
                <div class="form-group row mt-4">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-8">
                        <select class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id" aria-label="Default select example">
                            <option disabled value="">Pilih Program Studi</option>
                            @foreach ($prd as $prodis )
                            <option value="{{ $prodis->id }}" {{ old('prodi_id', $dsn->prodi_id) == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
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
                        <input type="email" name="email_dosen" value="{{ old('email_dosen', $dsn->email_dosen) }}" class="form-control @error('email_dosen') is-invalid @enderror" id="colFormLabel"
                            placeholder="Silahkan Masukkan E-mail Anda">
                                @error('email_dosen')
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
            @if ($dsn->roles_id == '2')
            <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ttdModal">Tanda Tangan</a>
            @elseif ($dsn->roles_id == '3')
            <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ttdModal">Tanda Tangan</a>
            @endif
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

<!-- Modal lihat tanda tangan-->
<div class="modal fade" id="ttdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Tanda Tangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($dosen as $isi)
                @if ($isi->roles_id == '2')
                    <form enctype="multipart/form-data" action="/update_ttdkadep/{{ $isi->id }}" method="post">
                    @csrf
                    @if (is_null($isi->ttd_kadep))
                        <p style="color: red;">Anda Belum Menambahkan Tanda Tangan Kadep</p>
                    @else
                    <img src="/image/{{ $isi->ttd_kadep }}"  width="auto" height="200px" style="align:center">
                    @endif
                            <input class="form-control" type="file" id="formFile" name="ttd_kadep">
                    </div>
                @else
                    <form enctype="multipart/form-data" action="/update_ttdwd/{{ $isi->id }}" method="post">
                        @csrf
                        @if (is_null($isi->ttd_wd))
                            <p style="color: red;">Anda Belum Menambahkan Tanda Tangan Wakil Dekan</p>
                        @else
                        <img src="/image/{{ $isi->ttd_wd }}"  width="auto" height="200px" style="align:center">
                        @endif
                                <input class="form-control" type="file" id="formFile" name="ttd_wd">
                        </div>
                @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        @endforeach
        @push('scripts')
                <script>
        $('#prodi_id option:not(:selected)').prop('disabled', true);
                    function myFunction() {
                        var x = document.getElementById("recipient-name");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
        function getJabatan() {
        let jabatan = $("#jabatan").val()
        console.log(jabatan);
        $("#pangkat").children().remove()
        $("#pangkat").val('');
        $("#pangkat").append(`<option value="" name="pangkat">Pilih Golongan</option>`)
        $("#pangkat").prop('disabled',true)
        if(jabatan != '' && jabatan != null){
            $.ajax({
            url:"{{ url('') }}/list_nama_golongan/"+jabatan,
            success:function(res){
                console.log(res)
                $("#pangkat").prop('disabled',false)
                let tampilan_option = '';
                $.each(res,function(index,data){
                    for (var i=0; i < data.length; i++){
                    tampilan_option+=`<option name="pangkat" value="${data[i].id}">${data[i].nama_golongan}</option>`
                    }
                })
                $("#pangkat").append(tampilan_option)
            }
        });
        }
    }
                </script>
        @endpush

@endsection