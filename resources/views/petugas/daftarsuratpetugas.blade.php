@extends('petugas.main')

@section('petugas')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>Daftar Surat</h2>
<br>
<div class="table-responsive"  style="margin-bottom: 30px">
  <table class="table table-striped table-bordered" style="width:100%" id="daftarSurat">
    <thead>
      <tr>
        <th scope="col">No. Surat</th>
        <th scope="col">Nama Surat</th>
        <th scope="col">Nama</th>
        <th scope="col">Prodi</th>
        <th scope="col" style="display:none">id</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Status</th>
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody id="tabelsurat">
    @foreach($surat as $isi)
      <tr>
        @if(is_null($isi->no_surat))
        <td class="align-middle text-center" style="color:red">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </td>
        @else
        <td>{{$isi->no_surat}}</td>
        @endif
        <td>{{$isi->judul}}</td>
        <td>{{$isi->nama}}</td>
        @if($isi->approve == '1')
            @if(isset($isi->prodi_id))
              <td>{{$isi->prodi_id}}</td>
            @else
              <td style="color:blue">Staff Dekanat FT</td>
            @endif
        @else
            @if(isset($isi->prodi_id))
              <td>{{$isi->prodi->prodi}}</td>
            @else
              <td style="color:blue">Staff Dekanat FT</td>
            @endif
        @endif
        <td style="display:none">{{$isi->id}}</td>
        <td>{{ \Carbon\Carbon::parse($isi->tanggalawal)->isoFormat('D MMMM Y')}}</td>
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
  $('#daftarSurat').DataTable({order: [[4,'desc']]});
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