@extends('kadep.main')

@section('kadep')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
        <h2>Daftar Surat</h2>
        <br>
        <div class="table-responsive" name="daftarSurat">
          </a>
          <table class="table table-striped table-bordered" style="width:100%" id="daftarSurat">
            <thead>
              <tr>
                <th scope="col">Nama Surat</th>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Tanggal</th>
                <th scope="col"> </th>
              </tr>
            </thead>
            <tbody>
            @foreach($surat as $isi)
              <tr>
                <td>{{$isi->judul}}</td>
                <td>{{$isi->nama_dosen}}</td>
                <td>{{ \Carbon\Carbon::parse($isi->created_at)->isoFormat('D MMMM Y')}}</td>
                <td>
                <a href="/surat/{{ $isi->id }}" target="_blank" class="btn btn-secondary btn-sm">Lihat</a>
                <a href="/kadeptolak/{{ $isi->id }}" class="btn btn-danger btn-sm">Tolak</a>
                <button type="button" class="btn btn-success btn-sm" onClick="konfirmasi({{ $isi->id }})">Izinkan</button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
@endsection

<!-- Modal Konfirmasi izin -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeBtn">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" name="modal-body">
      Anda akan menyetujui surat?
            <input type="text" readonly class="form-control" style="display:none" id="ttdKadep" name="ttdKadep" value="{{Auth::user()->ttd_kadep}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="confirmBtn" onclick="izinSurat()">OK</button>
      </div>
    </div>
  </div>
</div>

@section('kadep_js')
<script>
$(document).ready(function() {
  $('#daftarSurat').DataTable({order: [[2,'asc']]});
});

function konfirmasi(id)
{
  let seturl = "{{ route("confirmIzin", ":id") }}";
  seturl = seturl.replace(':id', id);

  console.log(seturl);
  $.get(seturl, function(data){
    console.log(data);
    $('#confirmBtn').attr('onclick', `izinSurat(${data.surat.id})`);
    $("#confirmModal").modal('show');
  });
  $('#closeBtn').click(function(){
    $("#confirmModal").modal('hide');
	});
}

function izinSurat(id) {
  var ttd_kadep = $("#ttdKadep").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "{{ url('izinkankadep') }}"+'/'+id,
    type: "POST",
    data: {
      ttd_kadep: ttd_kadep,
    },
    dataType: 'json',
    success: function (data) {
      $("#confirmModal").modal('hide');
        window.location.reload(true);
    },
    error: function(err) {
      console.log(err.responseJSON);
      let err_log = err.responseJSON.errors;
      if (err.status == 422){
        $('#confirmModal').find('[name="modal-body"]')
        .html('<span style="color:red">'+err_log.ttd_kadep[0]+'</span>')
      }
      $('#confirmBtn').click(function(){
        $("#confirmModal").modal('hide');
        window.location.reload(true);
      });
    }
  });
}
</script>
@endsection