@extends('petugas.main')

@section('petugas')
<title>Edit Surat</title>

<h1 class="h2">Tambah/Edit Nomor Surat</h1>
    @foreach($surat as $isi)
        <form class="mb-8" method="post" action="/updatenomorsurat/{{ $isi->id }}">
        @csrf
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">No. Surat</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="no_surat" autofocus required>
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Nama Dosen</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="nama" value="{{ $isi->nama_dosen }}" readonly >
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="nip" value="{{ $isi->NIP }}" readonly >
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Departemen/Prodi</label>
            <div class="col-sm-5">
                <input type="text" readonly class="form-control" placeholder=" " name="prodi" value="{{ $isi->prodi }}" readonly >
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="judul" value="{{ $isi->judul }}" readonly >
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tempat Kegiatan</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="tempat" value="{{ $isi->tempat }}" readonly >
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Kota/Kabupaten</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="kota" value="{{ $isi->kota }}" readonly >
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Awal Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" placeholder=" " name="tanggalawal" value="{{ $isi->tanggalawal }}" readonly >
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Tanggal Akhir Perjalanan Dinas</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" placeholder=" " name="tanggalakhir" value="{{ $isi->tanggalakhir }}" readonly >
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