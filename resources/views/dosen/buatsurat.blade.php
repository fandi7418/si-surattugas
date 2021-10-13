@extends('dosen.main')

@section('dosen')
<title>Buat Surat</title>

        <h1 class="h2">Buat Surat</h1>
        <form class="mb-8" method="post" action="/tambahsurat">
        @csrf
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama Dosen</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="nama" value="{{ Auth::guard('dosen')->user()->nama_dosen }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="nip" value="{{ Auth::guard('dosen')->user()->NIP }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="prodi" value="{{ Auth::guard('dosen')->user()->prodi_dosen }}">
            </div>
        </div>
        <!-- <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
            <div class="col-sm-5">
                <select class="form-select" aria-label="Default select example" name="prodi" disabled="true">
                    <option selected>{{ Auth::guard('dosen')->user()->prodi_dosen }}</option>
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
        </div> -->

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="pangkat">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="jabatan">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="judul">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Jenis Kegiatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="jeniskegiatan">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="tempat">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Kota/Kabupaten</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="kota">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Awal Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" placeholder=" " name="tanggalawal">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Akhir Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" placeholder=" " name="tanggalakhir">
            </div>
        </div>
        <div class="col-sm-7">
        <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px; margin-bottom: 20px">
            Simpan
        </button>
        </div>
            <!-- <div class="col-sm-7">
            <button action="/buatsurat/tampilsurat" type="submit" class="btn btn-secondary" style="float: right; margin-right: 10px; margin-bottom: 20px">
                Lihat dalam PDF
            </button>
            </div> -->
        </div>
    </form>
   
@endsection