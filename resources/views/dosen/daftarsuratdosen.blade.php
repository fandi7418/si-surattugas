@extends('dosen.main')

@section('dosen')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>Daftar Surat</h2>
<br>
<div class="table-responsive" style="margin-bottom: 50px">
  <table class="table table-striped table-bordered" style="width:100%;" id="daftarSurat">
    <thead>
      <tr style="text-align:center">
        <th scope="col">No. Surat</th>
        <th scope="col">Nama Surat</th>
        <th scope="col">Tanggal</th>
        <th scope="col" style="width:400px;">Tracking</th>
        <th scope="col" style="display:none">id</th>
        <th scope="col"> </th>
      </tr>
    </thead>
    <tbody>
      @foreach($surat as $isi)
      <tr>
        @if($isi->status_id == '5')
        <td class="align-middle" style="color:red; text-align: center">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </td>
        @elseif($isi->status_id == '6')
        <td class="align-middle" style="color:red; text-align: center">
          <i class="bi bi-exclamation-triangle-fill"></i>
        </td>
        @else
        <td>{{$isi->no_surat}}</td>
        @endif
        <td>{{$isi->judul}}</td>
        <td>{{ \Carbon\Carbon::parse($isi->created_at)->isoFormat('D MMMM Y')}}</td>
        @if($isi->status_id == '1')
        <td>
          <div class="container">
            <div class="row text-center w-10" style="color:grey">
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div></div>
              <div class="col"  style="color:green"><small>Pengajuan</small></div>
              <div class="col"><small>Kadep</small></div>
              <div class="col"><small>WD 1</small></div>
              <div class="col"><small>Penomoran</small></div>
            </div>
          </div>
        </td>
        @elseif($isi->status_id == '2')
        <td>
          <div class="container">
            <div class="row text-center w-10" style="color:grey">
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div></div>
              <div class="col" style="color:green"><small>Pengajuan</small></div>
              <div class="col" style="color:green"><small>Kadep</small></div>
              <div class="col"><small>WD 1</small></div>
              <div class="col"><small>Penomoran</small></div>
            </div>
          </div>
        </td>
        @elseif($isi->status_id == '3')
        <td>
          <div class="container">
            <div class="row text-center w-10" style="color:grey">
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div></div>
              <div class="col" style="color:green"><small>Pengajuan</small></div>
              <div class="col" style="color:green"><small>Kadep</small></div>
              <div class="col" style="color:green"><small>WD 1</small></div>
              <div class="col"><small>Penomoran</small></div>
            </div>
          </div>
        </td>
        @elseif($isi->status_id == '4')
        <td>
          <div class="container">
            <div class="row text-center w-10" style="color:grey">
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div></div>
              <div class="col" style="color:green"><small>Pengajuan</small></div>
              <div class="col" style="color:green"><small>Kadep</small></div>
              <div class="col" style="color:green"><small>WD 1</small></div>
              <div class="col" style="color:green"><small>Penomoran</small></div>
            </div>
          </div>
        </td>
        @elseif($isi->status_id == '5')
        <td>
          <div class="container">
            <div class="row text-center w-10" style="color:grey">
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-x-circle-fill" style="color:red"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div></div>
              <div class="col" style="color:green"><small>Pengajuan</small></div>
              <div class="col" style="color:red"><small>Kadep</small></div>
              <div class="col"><small>WD 1</small></div>
              <div class="col"><small>Penomoran</small></div>
            </div>
          </div>
        </td>
        @elseif($isi->status_id == '6')
        <td>
          <div class="container">
            <div class="row text-center w-10" style="color:grey">
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-check-circle-fill" style="color:green"></i>
              </div>
              <div class="col">
                <i class="bi bi-x-circle-fill" style="color:red"></i>
              </div>
              <div class="col">
                <i class="bi bi-clock" width="15" height="15"></i>
              </div>
              <div></div>
              <div class="col" style="color:green"><small>Pengajuan</small></div>
              <div class="col" style="color:green"><small>Kadep</small></div>
              <div class="col" style="color:red"><small>WD 1</small></div>
              <div class="col"><small>Penomoran</small></div>
            </div>
          </div>
        </td>
        @endif
        <td style="display:none">{{$isi->id}}</td>
        @if($isi->status_id == '4')
        <td style="text-align: center">
          <a href="/surat/{{ $isi->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
        </td>
        @elseif($isi->status_id == '5')
        <td style="text-align: center">
          <a href="/surat/{{ $isi->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
        </td>
        @elseif($isi->status_id == '6')
        <td style="text-align: center">
          <a href="/surat/{{ $isi->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
        </td>
        @else
        <td style="text-align: center">
          <a href="/surat/{{ $isi->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
          <button class="btn btn-primary btn-sm" onClick="editSurat({{ $isi->id }})">Edit</button>
          <button type="button" class="btn btn-danger btn-sm" onClick="konfirmasiHapus({{ $isi->id }})">Hapus</button>
        </td>
        @endif
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


<!-- Modal Konfirmasi tolak -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:red">Peringatan !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnClose">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" name="modal-body">
      Anda yakin ingin menghapus surat?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="hapusBtn" onclick="hapusSurat()">HAPUS</button>
      </div>
    </div>
  </div>
</div>


@section('dosen_js')
<script>
$(document).ready(function() {
  $('#daftarSurat').DataTable({order: [[4,'desc']]});
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

// konfirmasi untuk menghapus surat
function konfirmasiHapus(id)
{
  let seturl = "{{ route("confirmHapus", ":id") }}";
  seturl = seturl.replace(':id', id);

  console.log(seturl);
  $.get(seturl, function(data){
    console.log(data);
    $('#hapusBtn').attr('onclick', `hapusSurat(${data.surat.id})`);
    $("#hapusModal").modal('show');
  });
  $('#btnClose').click(function(){
    $("#hapusModal").modal('hide');
	});
}

function hapusSurat(id) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "{{ url('hapussurat') }}"+'/'+id,
    type: "POST",
    dataType: 'json',
    success: function (data) {
      $("#hapusModal").modal('hide');
        window.location.reload(true);
    },
  });
}
</script>
@endsection