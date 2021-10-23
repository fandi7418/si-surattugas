@extends('petugas.main')

@section('petugas')
<title>Daftar Surat</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
        <h2>Daftar Surat</h2>
        <div class="table-responsive" style="margin-right: 25px">
            <select class="btn btn-secondary dropdown-toggle btn-sm" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false" style="float: right">Pilih Program Studi
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
        <table class="table table-striped table-sm">
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
              <td>{{$isi->no_surat}}</td>
              <td>{{$isi->judul}}</td>
              <td>{{$isi->nama_dosen}}</td>
              <td>{{$isi->prodi->prodi}}</td>
              <td>{{ \Carbon\Carbon::parse($isi->tanggalawal)->isoFormat('D MMMM Y')}}</td>
              <td>{{$isi->status}}</td>
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
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeBtn">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form>
                @csrf
                <div class="form-group">
                  <label for="formGroupExampleInput">Masukkan nomor surat</label>
                  <input type="text" class="form-control" id="nomorSurat" name="nomorSurat">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="closeBtn" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" onClick="updateNomor({{ $isi->id }})">Save changes</button>
            </div>
          </div>
        </div>
      </div>

@section('inline_js')
<script>

function editNomor(id)
{
  
  let seturl = "{{ route("editnomorsurat", ":id") }}";
  seturl = seturl.replace(':id', id);


  console.log(seturl);
  $.get(seturl, function(data){
    console.log(data);
    $("#nomorSurat").val(data.surat.no_surat);
    $("#exampleModal").modal('show');
  });
  $('#closeBtn').click(function(){
    $("#exampleModal").modal('hide');
	});
}

function updateNomor(id)
{
  event.preventDefault()
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
    }
  });
  $("#idSurat").attr("onclick","updateNomor()");
}
</script>
@endsection