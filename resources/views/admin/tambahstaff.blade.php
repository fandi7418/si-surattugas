@extends('admin.main')

@section('container')

<h1 class="">Tambah Staff</h1>
<form style="margin-right: 10px" method="POST" action="/tambah_staff">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" name="nama_staff" value="{{ old('nama_staff') }}"
                class="form-control @error('nama_staff') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan Nama Anda">
            @error('nama_staff')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-8">
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{ old('NIP') }}"
                name="NIP" class="form-control @error('NIP') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan NIP Anda">
            @error('NIP')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Pangkat/Gol</label>
        <div class="col-sm-8">
            <select class="form-select @error('pangkat') is-invalid @enderror" name="pangkat" id="pangkat"
                aria-label="Default select example">
                <option value="">Pilih Pangkat/Gol</option>
                <option value="III/a" @if (old('pangkat') == "III/a") {{ 'selected' }} @endif>III/a</option>
                <option value="III/b" @if (old('pangkat') == "III/b") {{ 'selected' }} @endif>III/b</option>
                <option value="III/c" @if (old('pangkat') == "III/c") {{ 'selected' }} @endif>III/c</option>
                <option value="III/d" @if (old('pangkat') == "III/d") {{ 'selected' }} @endif>III/d</option>
                <option value="IV/a" @if (old('pangkat') == "IV/a") {{ 'selected' }} @endif>IV/a</option>
                <option value="IV/b" @if (old('pangkat') == "IV/b") {{ 'selected' }} @endif>IV/b</option>
                <option value="IV/c" @if (old('pangkat') == "IV/c") {{ 'selected' }} @endif>IV/c</option>
                <option value="IV/d" @if (old('pangkat') == "IV/d") {{ 'selected' }} @endif>IV/d</option>
                <option value="IV/e" @if (old('pangkat') == "IV/e") {{ 'selected' }} @endif>IV/e</option>
            </select>
            @error('pangkat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-8">
            <select class="form-select @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan"
                aria-label="Default select example">
                <option value="">Pilih Jabatan</option>
                <option value="Asisten Ahli" @if (old('jabatan') == "Asisten Ahli") {{ 'selected' }} @endif>Asisten Ahli</option>
                <option value="Lektor" @if (old('jabatan') == "Lektor") {{ 'selected' }} @endif>Lektor</option>
                <option value="Lektor Kepala" @if (old('jabatan') == "Lektor Kepala") {{ 'selected' }} @endif>Lektor Kepala</option>
                <option value="Profesor" @if (old('jabatan') == "Profesor") {{ 'selected' }} @endif>Profesor</option>
            </select>
            @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-8">
            <select class="form-select @error('roles_id') is-invalid @enderror" name="roles_id" id="roles_id"
                aria-label="Default select example">
                <option value="">Pilih Status</option>
                <option value="4" @if (old('roles_id') == "4") {{ 'selected' }} @endif>Staff Dekanat FT</option>
                <option value="5" @if (old('roles_id') == "5") {{ 'selected' }} @endif>Staff Departemen</option>
            </select>
            @error('roles_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
        <div class="col-sm-8">
            <select class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id" id="prodi_id"
                aria-label="Default select example">
                <option value="">Pilih Program Studi</option>
                @foreach ($prd as $prodis )
                <option value="{{ $prodis->id }}" {{ old('prodi_id') == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
                @endforeach
            </select>
            <small class="form-text" style="color: blue">Prodi diisi khusus untuk Staff Departemen</small>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" name="email_staff" value="{{ old('email_staff') }}"
                class="form-control @error('email_staff') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan E-mail Anda">
            @error('email_staff')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-5">
            <input type="password" name="password" value="{{ old('password') }}"
                class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                placeholder="Silahkan Masukkan Password Anda">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <input type="checkbox" onclick="myFunction()"> Tampilkan Password
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
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
