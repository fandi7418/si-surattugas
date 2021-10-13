@extends('admin.main')

@section('container')
                <h1 class="">Edit Profile</h1>
                @foreach ($wakildekan as $wd1)
                    <form style="margin-right: 10px" method="post" action="/update_wakildekan/{{ $wd1->id }}">
                        @csrf
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="colFormLabel" name="nama" value="{{ $wd1->nama_wd }}" >
                        </div>
                                </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-8">
                                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" id="colFormLabel" name="NIP" value="{{ $wd1->NIP }}" >
                        </div>
                                </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="colFormLabel" name="email" value="{{ $wd1->email_wd }}">
                        </div>
                                </div>
                        {{-- <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="inputPassword" value='{{ Auth::guard('admin')->user()->password }}'>
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
                                @foreach ($wakildekan as $wd1)
                                <form action="/update_passwordwd/{{ $wd1->id }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
                                    <input type="password" required minlength="6" name="password" class="form-control" id="inputPassword">
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