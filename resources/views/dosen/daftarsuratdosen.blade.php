@extends('dosen.main')

@section('dosen')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>Daftar Surat</h2>
<br>
<div class="table-responsive">
  <table class="table table-striped table-bordered" style="width:100%" id="daftarSurat">
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
        @if($isi->status_id == '5')
        <td class="align-middle" style="color:red">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        </td>
        @elseif($isi->status_id == '6')
        <td class="align-middle" style="color:red">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        </td>
        @else
        <td>{{$isi->no_surat}}</td>
        @endif
        <td>{{$isi->judul}}</td>
        <td>{{ \Carbon\Carbon::parse($isi->created_at)->isoFormat('D MMMM Y')}}</td>
        @if($isi->status_id == '5')
        <td style="color:red">{{$isi->status->status}}</td>
        @elseif($isi->status_id == '6')
        <td style="color:red">{{$isi->status->status}}</td>
        @else
        <td>{{$isi->status->status}}</td>
        @endif
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

@section('dosen_js')
<script>
$(document).ready(function() {
  $('#daftarSurat').DataTable({order: [[2,'asc']]});
});

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