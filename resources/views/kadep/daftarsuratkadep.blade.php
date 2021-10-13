@extends('kadep.main')

@section('kadep')
<title>Daftar Surat</title>

        <h2>Daftar Surat</h2>
      <div class="table-responsive">
        <a class="btn btn-secondary btn-sm" style="float:right" href="" data-toggle="modal" data-target="#exampleModal">Tambah</a>
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
              <a href="/surat/{{ $isi->id }}" target="_blank" class="btn btn-secondary btn-sm">Lihat</a>
              <a href="/tolak/{{ $isi->id }}" class="btn btn-danger btn-sm">Tolak</a>
              <a href="/izinkankadep/{{ $isi->id }}" class="btn btn-success btn-sm">Izinkan</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Tanda Tangan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form enctype="multipart/form-data" method="post" action="/uploadttdkadep">
              @csrf
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label"></label>
                  <div class="form-group">
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="ttd">
                    <br>
                    <br>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      Upload tanda tangan untuk memberi perizinan surat
                    </small>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Upload</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection