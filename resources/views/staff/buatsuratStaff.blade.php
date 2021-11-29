@extends('staff.main')

@section('staff')
<title>Buat Surat</title>

<h1 class="h2">Buat Surat</h1>
<br>
@if(Auth::guard('staff')->user()->roles_id == '5')
<form class="mb-8" method="post" action="/tambahsuratStaff">
    @csrf
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nama" value="{{ Auth::guard('staff')->user()->nama_staff }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nip" value="{{ Auth::guard('staff')->user()->NIP }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="prodi" value="{{ Auth::guard('staff')->user()->prodi->prodi }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="pangkat" value="{{ Auth::guard('staff')->user()->pangkat }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="jabatan" value="{{ Auth::guard('staff')->user()->jabatan }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="judul" value="{{ old('judul') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jenis Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="jeniskegiatan" value="{{ old('jeniskegiatan') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="tempat" value="{{ old('tempat') }}">
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
@elseif(Auth::guard('staff')->user()->roles_id == '4')
<form class="mb-8" method="post" action="/tambahsuratStaffFT">
    @csrf
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nama" value="{{ Auth::guard('staff')->user()->nama_staff }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nip" value="{{ Auth::guard('staff')->user()->NIP }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="pangkat" value="{{ Auth::guard('staff')->user()->pangkat }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="jabatan" value="{{ Auth::guard('staff')->user()->jabatan }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="judul" value="{{ old('judul') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jenis Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="jeniskegiatan" value="{{ old('jeniskegiatan') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="tempat" value="{{ old('tempat') }}">
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
@elseif(Auth::guard('staff')->user()->roles_id == '6')
<form class="mb-8" method="post" action="/tambahsuratStaffFT">
    @csrf
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nama" value="{{ Auth::guard('staff')->user()->nama_staff }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="nip" value="{{ Auth::guard('staff')->user()->NIP }}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Pangkat/Gol</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="pangkat" value="{{ Auth::guard('staff')->user()->pangkat }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" placeholder=" " name="jabatan" value="{{ Auth::guard('staff')->user()->jabatan }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="judul" value="{{ old('judul') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Jenis Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="jeniskegiatan" value="{{ old('jeniskegiatan') }}">
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" placeholder=" " name="tempat" value="{{ old('tempat') }}">
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
@endif


@endsection