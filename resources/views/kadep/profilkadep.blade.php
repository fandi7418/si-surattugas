@extends('kadep.main')

@section('kadep')
<title>Profil</title>

    <h1 class="h2">Edit Profil</h1>
    <form>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-5">
                <select class="form-select" aria-label="Default select example">
                        <option selected> </option>
                        <option value="1">Teknik Sipil</option>
                        <option value="2">Teknik Arsitektur</option>
                        <option value="3">Teknik Kimia</option>
                        <option value="3">Teknik Perencanaan Wilayah dan Kota</option>
                        <option value="3">Teknik Mesin</option>
                        <option value="3">Teknik Elektro</option>
                        <option value="3">Teknik Perkapalan</option>
                        <option value="3">Teknik Industri</option>
                        <option value="3">Teknik Lingkungan</option>
                        <option value="3">Teknik Geologi</option>
                        <option value="3">Teknik Geodesi</option>
                        <option value="3">Teknik Komputer</option>
                    </select>
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-5">
                <input type="password" id="myInput">
                <a onclick="myFunction()" style="margin-left: 10px">
                    <svg onclick="myFunction()" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="col-sm-7">
        <button type="button" class="btn btn-primary" style="float: right; margin-right: 10px">
            Simpan
        </button>
        </div>
    </form>
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