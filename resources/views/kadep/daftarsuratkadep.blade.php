@extends('kadep.main')

@section('kadep')
<title>Daftar Surat</title>

        <h2>Daftar Surat</h2>
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
              <a href="/surat/{{ $isi->id }}" target="_blank" class="btn btn-secondary btn-sm">Lihat</a>
              <a href=" " class="btn btn-danger btn-sm">Tolak</a>
              <a href="/izinkan/{{ $isi->id }}" class="btn btn-success btn-sm">Izinkan</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>

@endsection