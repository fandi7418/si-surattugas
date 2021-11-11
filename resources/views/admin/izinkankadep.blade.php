@extends('admin.main')

@section('container')

<h1 class="">Izinkan Surat dengan Tanda Tangan Ketua Departenen</h1>
<br>
@foreach ($surat as $srt )

<form enctype="multipart/form-data" method="post" action="{{ url('postizinkankadep/'. $srt->id) }}"
    style="margin-right: 10px">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-8">
            <input disabled readonly type="text" name="judul" value="{{ old('judul', $srt->judul) }}"
                class="form-control @error('judul') is-invalid @enderror" id="colFormLabel"
                >
            @error('email_surat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Dosen</label>
        <div class="col-sm-8">
            <input disabled readonly type="text" name="judul" value="{{ old('nama_dosen', $srt->nama_dosen) }}"
                class="form-control @error('judul') is-invalid @enderror" id="colFormLabel"
                >
            @error('email_surat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
        <div class="col-sm-8">                
            <input disabled readonly type="text" name="judul" value="{{$srt->prodi->prodi}}"
            class="form-control @error('prodi_id') is-invalid @enderror" id="colFormLabel"
            >
            @error('prodi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Kadep</label>
        <div class="col-sm-8">
            <input disabled readonly type="text" name="nama_kadep" value="{{ old('nama_kadep', $srt->nama_kadep) }}"
                class="form-control @error('nama_kadep') is-invalid @enderror" id="colFormLabel"
                >
            @error('nama_kadep')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    {{-- <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Kadep</label>
        <div class="col-sm-8">
            <input class="form-control" required type="file" id="ttd_kadep" name="ttd_kadep">
            @error('ttd_kadep')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div> --}}

    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>
@endforeach

@endsection
