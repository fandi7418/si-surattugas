@extends('admin.main')

@section('container')

<h1 class="">Tambah Supervisor</h1>
<a href="/data_supervisor" class="btn btn-info btn-sm" style="float: right">Kembali</a>
<br>
<form method="post" action="/tambah_supervisor" style="margin-right: 10px">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Bagian</label>
        <div class="col-sm-8">
            <select class="form-select  @error('bagian') is-invalid @enderror" onchange="getSpv()" name="bagian" id="bagian" aria-label="Default select example">
                <option value>Pilih Bagian Staff</option>
                @foreach ($bagian as $bagianstf )
                <option value="{{ $bagianstf->id }}" {{ old('bagian_id') == $bagianstf->id ? 'selected' : null }}>{{ $bagianstf->bagian }}</option>
                @endforeach
            </select>
            @error('bagian')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-8">
            <select class="form-select @error('nama_spv') is-invalid @enderror" name="nama_spv" id="nama_spv" aria-label="Default select example"disabled>
                <option>Pilih Staff</option>
            </select>
            @error('nama_spv')
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
    $('#nama_spv').select2();
    $('#bagian').select2();
    });
    function getSpv() {
        let bagian = $("#bagian").val()
        console.log(bagian);
        $("#nama_spv").children().remove()
        $("#nama_spv").val('');
        $("#nama_spv").append(`<option value="" name="nama_spv">Pilih Staff</option>`)
        $("#nama_spv").prop('disabled',true)
        if(bagian != '' && bagian != null){
            $.ajax({
            url:"{{ url('') }}/list_nama_staff/"+bagian,
            success:function(res){
                console.log(res)
                $("#nama_spv").prop('disabled',false)
                let tampilan_option = '';
                $.each(res,function(index,data){
                    for (var i=0; i < data.length; i++){
                    tampilan_option+=`<option name="nama_spv" value="${data[i].id}">${data[i].nama}</option>`
                    }
                })
                $("#nama_spv").append(tampilan_option)
            }
        });
        }
    }
</script>

@endpush