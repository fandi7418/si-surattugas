@extends('admin.main')

@section('container')
                <h1 class="">Edit Profile</h1>
                    <form style="margin-right: 10px">
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="colFormLabel" value='{{ Auth::guard('admin')->user()->nama_admin }}' >
                        </div>
                                </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="colFormLabel" value='{{ Auth::guard('admin')->user()->NIP }}' >
                        </div>
                                </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="colFormLabel" value='{{ Auth::guard('admin')->user()->email_admin }}'>
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
                                    <button type="button" class="btn btn-primary">Simpan</button>
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