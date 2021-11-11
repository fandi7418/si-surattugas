@extends('admin.main')

@section('container')

<h1 class="">Izinkan Surat dengan Tanda Tangan Wakil Dekan</h1>
<br>
@foreach ($surat as $srt )

<form enctype="multipart/form-data" method="post" action="{{ url('postizinkanwakildekan/'. $srt->id) }}"
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
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Wakil Dekan</label>
        <div class="col-sm-8">
            <input disabled readonly type="text" name="nama_wd" value="{{ old('nama_wd', $srt->nama_wd) }}"
                class="form-control @error('nama_wd') is-invalid @enderror" id="colFormLabel"
                >
            @error('nama_wd')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    {{-- <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Wakil Dekan</label>
        <div class="col-sm-8">
            <input class="form-control @error('ttd_wd') is-invalid @enderror" type="file" id="ttd_wd" name="ttd_wd">
            @error('ttd_wd')
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
