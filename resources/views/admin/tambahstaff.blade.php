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
        <label for="colFormLabel" class="col-sm-2 col-form-label">NIP/NPPU</label>
        <div class="col-sm-8">
            <input type="text" value="{{ old('NIP') }}"
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
        <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-8">
            <select class="form-select @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan"
                aria-label="Default select example">
                <option value="">Pilih Jabatan</option>
                @foreach ($jabatan as $jbtn )
                <option value="{{ $jbtn->id }}" {{ old('jabatan_id') == $jbtn->id ? 'selected' : null }}>{{ $jbtn->nama_jabatan }}</option>
                @endforeach
            </select>
            @error('jabatan')
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
                @foreach ($golongan as $gol )
                <option value="{{ $gol->id }}" {{ old('golongan_id') == $gol->id ? 'selected' : null }}>{{ $gol->nama_golongan }}</option>
                @endforeach
            </select>
            @error('pangkat')
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
            <select disabled class="form-select @error('prodi_id') is-invalid @enderror" name="prodi_id" id="prodi_id"
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
        <label for="colFormLabel" class="col-sm-2 col-form-label">Bagian</label>
        <div class="col-sm-8">
            <select class="form-select @error('bagianstaff_id') is-invalid @enderror" name="bagianstaff_id" id="bagianstaff_id"
                aria-label="Default select example">
                <option value="">Pilih Bagian Staff</option>
                @foreach ($bagian as $bagianstf )
                <option value="{{ $bagianstf->id }}" {{ old('bagianstaff_id') == $bagianstf->id ? 'selected' : null }}>{{ $bagianstf->bagian }}</option>
                @endforeach
            </select>
            @error('bagianstaff_id')
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
@push('scripts')
<script>
    function myFunction() {
        var x = document.getElementById("inputPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    

$("#roles_id").change(function() {
			//console.log($("#roles_id option:selected").val());
			if ($("#roles_id option:selected").val() == '4') {
                $("#prodi_id").val('');
				$('#prodi_id').prop('disabled', true);
			} else if ($("#roles_id option:selected").val() == '') {
                $("#prodi_id").val('');
                $('#prodi_id').prop('disabled', true);
			} else {
				$('#prodi_id').prop('disabled', false);
            }
		});

</script>
    @endpush

@endsection
