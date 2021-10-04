@extends('dosen.main')

@section('dosen')
<title>Edit Surat</title>

<h1 class="h2">Buat Surat</h1>
    @foreach($surat as $isi)
        <form class="mb-8" method="post" action="/updatesurat/{{ $isi->id }}">
        @csrf
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama Dosen</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="nama" value="{{ $isi->nama_dosen }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="nip" value="{{ $isi->NIP }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="prodi" value="{{ $isi->prodi }}">
            </div>
        </div>
        <!-- <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
            <div class="col-sm-5" value="{{ $isi->prodi }}">
                <select class="form-select" aria-label="Default select example" name="prodi">
                    <option selected>{{ $isi->prodi }}</option>
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
                <input type="text" class="form-control" placeholder=" " name="pangkat" value="{{ $isi->pangkat }}">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="judul" value="{{ $isi->judul }}">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Jenis Kegiatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="jeniskegiatan" value="{{ $isi->jenis }}">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="tempat" value="{{ $isi->tempat }}">
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Kota/Kabupaten</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="kota" value="{{ $isi->kota }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Awal Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" placeholder=" " name="tanggalawal" value="{{ $isi->tanggalawal }}">
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Akhir Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" placeholder=" " name="tanggalakhir" value="{{ $isi->tanggalakhir }}">
            </div>
        </div>
        <div class="col-sm-7">
        <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px; margin-bottom: 20px">
            Simpan
        </button>
        </div>
        </div>
    </form>
    @endforeach
   
@endsection