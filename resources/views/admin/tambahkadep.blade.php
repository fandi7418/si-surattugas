@extends('admin.main')

@section('container')

<h1 class="">Tambah Ketua Departemen</h1>
<a href="/data_kadep" class="btn btn-info btn-sm" style="float: right">Kembali</a>
<br>
<form method="post" action="/tambah_kadep" style="margin-right: 10px">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Program Studi</label>
        <div class="col-sm-8">
            <select class="form-select  @error('prodi') is-invalid @enderror" onchange="getKadep()" name="prodi" id="prodi" aria-label="Default select example">
                <option value>Pilih Program Studi</option>
                @foreach ($prd as $prodis )
                <option value="{{ $prodis->id }}" {{ old('prodi_id') == $prodis->id ? 'selected' : null }}>{{ $prodis->prodi }}</option>
                @endforeach
            </select>
            @error('prodi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-8">
            <select class="form-select @error('nama_kadep') is-invalid @enderror" name="nama_kadep" id="nama_kadep" aria-label="Default select example"disabled>
                <option>Pilih Dosen</option>
            </select>
            @error('nama_kadep')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    {{-- <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" name="nama_kadep" id="nama" value=""
                class="form-control @error('nama_kadep') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan Nama Anda">
            @error('nama_kadep')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div> --}}
    {{-- <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-8">
            <input type="text" value=""
                name="NIP" class="form-control" id="nip"
                readonly>
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" name="email_kadep" id="email"
                class="form-control" readonly>
        </div>
    </div> --}}
    {{-- <div class="form-group row mt-4">
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
    </div> --}}
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
    $('#nama_kadep').select2();
    $('#prodi').select2();
    });
    function getKadep() {
        let prodi = $("#prodi").val()
        console.log(prodi);
        $("#nama_kadep").children().remove()
        $("#nama_kadep").val('');
        $("#nama_kadep").append(`<option value="" name="nama_kadep">Pilih Dosen</option>`)
        $("#nama_kadep").prop('disabled',true)
        if(prodi != '' && prodi != null){
            $.ajax({
            url:"{{ url('') }}/list_nama_dosen/"+prodi,
            success:function(res){
                console.log(res)
                $("#nama_kadep").prop('disabled',false)
                let tampilan_option = '';
                $.each(res,function(index,data){
                    for (var i=0; i < data.length; i++){
                    tampilan_option+=`<option name="nama_kadep" value="${data[i].id}">${data[i].nama_dosen}</option>`
                    }
                })
                $("#nama_kadep").append(tampilan_option)
            }
        });
        }
    }
</script>

@endpush