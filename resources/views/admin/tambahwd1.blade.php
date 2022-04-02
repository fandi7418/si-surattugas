@extends('admin.main')

@section('container')
<br>
    <h1 class="card-title">Tambah Wakil Dekan</h1>
<a href="/data_wakildekan" class="btn btn-info btn-sm" style="float: right">Kembali</a>
<br>
<form method="post" action="/tambah_wakildekan" style="margin-right: 10px">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Pilih WD</label>
        <div class="col-sm-8">
            <select class="form-select  @error('bagian') is-invalid @enderror" name="bagian" id="bagian" aria-label="Default select example">
                <option value="">Pilih Bagian WD</option>
                @foreach ($bagian as $bagians )
                <option value="{{ $bagians->id }}" {{ old('bagian') == $bagians->id ? 'selected' : null }}>{{ $bagians->bagian }}</option>
                @endforeach
            </select>
            @error('bagian')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    {{-- <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-8">
            <select class="form-select @error('bagian') is-invalid @enderror" name="bagian" id="bagian"
                aria-label="Default select example">
                <option value="">Pilih Status</option>
                <option value="4" @if (old('bagian') == "4") {{ 'selected' }} @endif>Staff Dekanat FT</option>
                <option value="5" @if (old('bagian') == "5") {{ 'selected' }} @endif>Staff Departemen</option>
            </select>
            @error('bagian')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div> --}}
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Pilih Wakil Dekan</label>
        <div class="col-sm-8">
            <select disabled class="form-select  @error('nama') is-invalid @enderror" name="nama" id="nama" aria-label="Default select example">
                <option value="">Pilih Wakil Dekan</option>
                @foreach ($wd as $wds )
                <option value="{{ $wds->id }}" {{ old('nama') == $wds->id ? 'selected' : null }}>{{ $wds->nama }}</option>
                @endforeach
            </select>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
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
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
    $('#nama').select2();
    $('#bagian').select2();
    });
    
    $("#bagian").change(function() {
			// console.log($("#bagian option:selected").val());
			if ($("#bagian option:selected").val() == '') {
                $("#nama").val('');
				$('#nama').prop('disabled', true);
			}  else {
				$('#nama').prop('disabled', false);
            }
		});
</script>

@endpush