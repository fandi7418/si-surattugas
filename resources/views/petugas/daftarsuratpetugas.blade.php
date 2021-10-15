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
              <td>{{ \Carbon\Carbon::parse($isi->tanggalawal)->isoFormat('D MMMM Y')}}</td>
              <td>{{$isi->status}}</td>
              <td>
              <a href="/surat/{{ $isi->id }}" target="_blank" class="btn btn-secondary btn-sm">Lihat</a>
              <a href="/editnomorsurat/{{ $isi->id }}" class="btn btn-primary btn-sm">Edit No. Surat</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
@endsection