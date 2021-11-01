@extends('petugas.main')

@section('petugas')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>Daftar Surat</h2>
<br>
<div class="table-responsive" style="margin-right: 25px">
  <select class="btn btn-secondary dropdown-toggle btn-sm" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false" style="float: right; margin-left:8px">
      Pilih Program Studi
      <ul class="dropdown-menu-dark" aria-labelledby="dropdown01">
          <li><option selected class="dropdown-item-dark" href="#">Semua</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Sipil</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Arsitektur</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Kimia</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Perencanaan Wilayah dan Kota</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Mesin</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Elektro</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Perkapalan</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Industri</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Lingkungan</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Geologi</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Geodesi</option></li>
          <li><option value="2" class="dropdown-item-dark" href="#">Teknik Komputer</option></li>
      </ul>
  </select>
  <table class="table table-striped table-bordered" style="width:100%" id="daftarSurat">
    <thead>
      <tr>
        <th scope="col">No. Surat</th>
        <th scope="col">Nama Surat</th>
        <th scope="col">Nama Dosen</th>
        <th scope="col">Prodi</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Status</th>
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody>
    @foreach($surat as $isi)
      <tr>
        @if(is_null($isi->no_surat))
        <td class="align-middle" style="color:red">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        </td>
        @else
        <td>{{$isi->no_surat}}</td>
        @endif
        <td>{{$isi->judul}}</td>
        <td>{{$isi->nama_dosen}}</td>
        <td>{{$isi->prodi->prodi}}</td>
        <td>{{ \Carbon\Carbon::parse($isi->created_at)->isoFormat('D MMMM Y')}}</td>
        @if(is_null($isi->no_surat))
        <td style="color:red">{{$isi->status->status}}</td>
        @else
        <td>{{$isi->status->status}}</td>
        @endif
        <td>
        <a href="/surat/{{ $isi->id }}" target="_blank" class="btn btn-secondary btn-sm">Lihat</a>
        <button onClick="editNomor({{ $isi->id }})" class="btn btn-primary btn-sm">
          Edit No. Surat
        </button>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>


@endsection
<!-- Modal Edit Nomor-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Nomor Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeBtn">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          @csrf
          <div class="form-group">
            <label for="formGroupExampleInput">Masukkan nomor surat</label>
            <input class="form-control" type="text" id="nomorSurat" name="nomorSurat">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="saveBtn" onclick="updateSubmit(0)">Simpan</button>
      </div>
    </div>
  </div>
</div>

@section('petugas_js')
<script>
$(document).ready(function() {
  $('#daftarSurat').DataTable({order: [[4,'asc']]});
});

function editNomor(id)
{
  
  let seturl = "{{ route("editnomorsurat", ":id") }}";
  seturl = seturl.replace(':id', id);


  console.log(seturl);
  $.get(seturl, function(data){
    console.log(data);
    $("#nomorSurat").val(data.surat.no_surat);
    $('#saveBtn').attr('onclick', `updateSubmit(${data.surat.id})`);
    $('#exampleModal').find('[name="nomorSurat"]').prev()
      .html('<span>Masukkan nomor surat</span>')
    $("#exampleModal").modal('show');
  });
  $('#closeBtn').click(function(){
    $("#exampleModal").modal('hide');
	});
}
function updateSubmit(id) {
  var no_surat = $("#nomorSurat").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "{{ url('updatenomorsurat') }}"+'/'+id,
    type: "POST",
    data: {
      no_surat: no_surat,
    },
    dataType: 'json',
    success: function (data) {
        $('#exampleModal').modal('hide');
        window.location.reload(true);
    },
    error: function(err) {
      console.log(err.responseJSON);
      let err_log = err.responseJSON.errors;
      if (err.status == 422){
        $('#exampleModal').find('[name="nomorSurat"]').prev()
        .html('<span style="color:red">'+err_log.no_surat[0]+'</span>')
      }
    }
  });
}
</script>
@endsection