@extends('wd.main')

@section('wd')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>Daftar Surat</h2>
<br>
<div class="table-responsive">
  <table class="table table-striped table-sm">
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
        <td>{{$isi->tanggalawal}}</td>
        <td>
        <a href="/surat/{{ $isi->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
        <a href="/tolak/{{ $isi->id }}" class="btn btn-danger btn-sm">Tolak</a>
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
            <input type="text" readonly class="form-control" style="display:none" id="ttdWD" name="ttdWD" value="{{Auth::user()->ttd_wd}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="confirmBtn" onclick="izinSurat()">OK</button>
      </div>
    </div>
  </div>
</div>

@section('WakilDekan_js')
<script>
function konfirmasi(id)
{
  let seturl = "{{ route("confirmIzinWD", ":id") }}";
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
  var ttd_wd = $("#ttdWD").val();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "{{ url('izinkan') }}"+'/'+id,
    type: "POST",
    data: {
      ttd_wd: ttd_wd,
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
        .html('<span style="color:red">'+err_log.ttd_wd[0]+'</span>')
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