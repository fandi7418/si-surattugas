


<form class="mb-8" method="post" action="/updatenomorsurat/{{ $isi->id }}">
        @csrf
        <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">No. Surat</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder=" " name="no_surat" value="{{ $surat->no_surat }}" autofocus required>
            </div>
        </div>
       
        <div class="col-sm-7">
        <button type="submit" class="btn btn-primary" style="float: right; margin-right: 10px; margin-bottom: 20px">
            Simpan
        </button>
        </div>
        </div>
    </form>