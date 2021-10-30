@extends('dosen.main')

@section('dosen')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>Daftar Surat</h2>
<br>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No. Surat</th>
        <th scope="col">Nama Surat</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Status</th>
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody>
      @foreach($surat as $isi)
      <tr>
        <td>{{$isi->no_surat}}</td>
        <td>{{$isi->judul}}</td>
        <td>{{ \Carbon\Carbon::parse($isi->created_at)->isoFormat('D MMMM Y')}}</td>
        <td>{{$isi->status->status}}</td>
        <td>
          <a href="/surat/{{ $isi->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
          <button class="btn btn-primary btn-sm" onClick="editSurat({{ $isi->id }})">Edit</button>
          <a href="/hapussurat/{{ $isi->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  {{ $surat->links() }}
  </ul>
</nav>
@endsection

<!-- Modal Edit Surat-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Isi Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeBtn">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          @csrf
          <div class="form-group mb-3">
              <label for="formGroupExampleInput">No. Surat</label>
              <input type="text" readonly class="form-control" id="nomorSurat" name="nomorSurat">
          </div>

          <div class="form-group mb-3">
              <label for="formGroupExampleInput">Judul</label>
              <input type="text" class="form-control" id="judulSurat" name="judulSurat">
          </div>

          <div class="form-group mb-3">
              <label for="formGroupExampleInput">Jenis Kegiatan</label>
              <input type="text" class="form-control" id="jenisSurat" name="jenisSurat">
          </div>

          <div class="form-group mb-3">
              <label for="formGroupExampleInput">Tempat Kegiatan</label>
              <input type="text" class="form-control" id="tempatSurat" name="tempatSurat">
          </div>

          <div class="form-group mb-3">
              <label for="formGroupExampleInput">Kota/Kabupaten</label>
              <input type="text" class="form-control" id="kotaSurat" name="kotaSurat">
          </div>
          <div class="form-group mb-3">
              <label for="formGroupExampleInput">Tanggal Awal Perjalanan Dinas</label>
              <input type="date" class="form-control" id="tglAwalSurat" name="tglAwalSurat">
          </div>
          <div class="form-group mb-3">
              <label for="formGroupExampleInput">Tanggal Akhir Perjalanan Dinas</label>
              <input type="date" class="form-control" id="tglAkhirSurat" name="tglAkhirSurat">
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="saveBtn" onclick="updateSubmit()">Simpan</button>
      </div>
    </div>
  </div>
</div>

@section('inline_js')
<script>

function editSurat(id)
{
  
  let seturl = "{{ route("editsurat", ":id") }}";
  seturl = seturl.replace(':id', id);


  console.log(seturl);
  $.get(seturl, function(data){
    console.log(data);
    $("#nomorSurat").val(data.surat.no_surat);
    $("#judulSurat").val(data.surat.judul);
    $("#jenisSurat").val(data.surat.jenis);
    $("#tempatSurat").val(data.surat.tempat);
    $("#kotaSurat").val(data.surat.kota);
    $("#tglAwalSurat").val(data.surat.tanggalawal);
    $("#tglAkhirSurat").val(data.surat.tanggalakhir);
    $('#saveBtn').attr('onclick', `updateSubmit(${data.surat.id})`);
    $("#exampleModal").modal('show');
  });
  $('#closeBtn').click(function(){
    $("#exampleModal").modal('hide');
	});
}
function updateSubmit(id) {
  var judul = $("#judulSurat").val();
  var jenis = $("#jenisSurat").val();
  var tempat = $("#tempatSurat").val();
  var kota = $("#kotaSurat").val();
  var tanggalawal = $("#tglAwalSurat").val();
  var tanggalakhir = $("#tglAkhirSurat").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "{{ url('updatesurat') }}"+'/'+id,
    type: "POST",
    data: {
      judul: judul,
      jenis: jenis,
      tempat: tempat,
      kota: kota,
      tanggalawal: tanggalawal,
      tanggalakhir: tanggalakhir,
    },
    dataType: 'json',
    success: function (data) {
        $('#exampleModal').modal('hide');
        window.location.reload(true);
    }
  });
}
</script>
@endsection