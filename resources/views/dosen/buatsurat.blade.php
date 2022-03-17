@extends('dosen.main')

@section('dosen')
<title>Buat Surat</title>

<h1 class="h2">Buat Surat</h1>
<br>
<form class="mb-8" method="post" action="/tambahsurat">
    @csrf
        @error('nama_wd')
        <div class="form-group row mb-2" style="margin-left: 1px">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 57%">
                <i class="bi bi-exclamation-triangle-fill" style="margin-right: 5px"></i>
                <strong>Gagal!</strong> &nbsp; {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @enderror
        @error('nama_kadep')
        <div class="form-group row mb-2" style="margin-left: 1px">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 57%">
                <i class="bi bi-exclamation-triangle-fill" style="margin-right: 5px"></i>
                <strong>Gagal!</strong> &nbsp; {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @enderror
    @foreach($kadep as $kdp)
        <input type="text" readonly class="form-control" style="display:none" name="nama_kadep" value="{{ $kdp->nama }}">
        <input type="text" readonly class="form-control" style="display:none" name="NIP_kadep" value="{{ $kdp->NIP }}">
    @endforeach
    @foreach($wd as $wakil)
        <input type="text" readonly class="form-control" style="display:none" name="nama_wd" value="{{ $wakil->nama }}">
        <input type="text" readonly class="form-control" style="display:none" name="NIP_wd" value="{{ $wakil->NIP }}">
    @endforeach
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Nama Dosen</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nama" value="{{ Auth::user()->nama }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nip" value="{{ Auth::user()->NIP }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="prodi" value="{{ Auth::user()->prodi->prodi }}">
        </div>
    </div>
    <div class="form-group row mb-2" style="display:none">
        <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="prodi_id" value="{{ Auth::user()->prodi->id }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="pangkat" value="{{ Auth::user()->golongan->nama_golongan }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="jabatan" value="{{ Auth::user()->jabatan->nama_jabatan }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder="Judul dari kegiatan yang dilaksanakan" name="judul" value="{{ old('judul') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jenis Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder="Jenis kegiatan, contoh: Seminar, Pelatihan, Workshop, dll" name="jeniskegiatan" value="{{ old('jeniskegiatan') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder="" name="tempat" value="{{ old('tempat') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Kota/Kabupaten</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="kota" value="{{ old('kota') }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Tanggal Awal Perjalanan Dinas</label>
        <div class="col-sm-5">
            <input type="date" required class="form-control @error('tanggalawal') is-invalid @enderror" placeholder=" " name="tanggalawal" value="{{ old('tanggalawal') }}">
            @error('tanggalawal')
                <div class="alert alert-danger alert-dismissible fade show mt-3">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Tanggal Akhir Perjalanan Dinas</label>
        <div class="col-sm-5">
            <input type="date" required class="form-control @error('tanggalakhir') is-invalid @enderror" placeholder=" " name="tanggalakhir" value="{{ old('tanggalakhir') }}">
            @error('tanggalakhir')
                <div class="alert alert-danger alert-dismissible fade show mt-3">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
    </div>
    <div class="col-sm-7">
        <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px; margin-bottom: 20px">
            Simpan
        </button>
    </div>
    
</form>

@endsection