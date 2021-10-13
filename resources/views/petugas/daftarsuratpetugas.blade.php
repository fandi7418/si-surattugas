@extends('petugas.main')

@section('petugas')
<title>Daftar Surat</title>

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
              <td>{{$isi->prodi}}</td>
              <td>{{$isi->tanggalawal}}</td>
              <td>{{$isi->status}}</td>
              <td>
              <a href="/surat/{{ $isi->id }}" target="_blank" class="btn btn-secondary btn-sm">Lihat</a>
              <a href="/editnomorsurat/{{ $isi->id }}" class="btn btn-primary btn-sm">Edit No. Surat</a>


              <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" 
              data-whatever="{{$isi->no_surat}}">Edit no.Surat</button> -->
              <!-- <a href="/editnomorsurat/{{ $isi->id }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Edit No. Surat</a> -->
              <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Launch demo modal
            </button> -->
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    

      <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div> -->

      <!-- <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">


          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
              <p>{{$isi->id}}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div> -->

      <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">No. Surat:</label>
                  <input type="text" class="form-control" id="recipient-name" value="{{$isi->no_surat}}">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Send message</button>
            </div>
          </div>
        </div>
      </div>


<script>
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  $.ajax({
      url: '/editnomorsurat/{id}',
      type: "GET",
      data: {
        no_surat: no_surat,
      },
  dataType: 'json',
}
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script> -->


@endsection