@extends('dosen.main')

@section('dosen')
<title>Buat Surat</title>

        <h1 class="h2">Buat Surat</h1>
        <form class="mb-5">
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama Dosen</label>
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
            <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
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
            <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Jenis Kegiatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Kota/Kabupaten</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Awal Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Akhir Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" ">
            </div>
        </div>
        <div class="col-sm-7">
        <button type="button" class="btn btn-primary" style="float: right; margin-right: 10px">
            Simpan
        </button>
        </div>
    </form>
   
@endsection