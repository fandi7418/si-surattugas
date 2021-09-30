@extends('admin.main')

@section('container')
                    <h2 class="mt-4">Data Ketua Departemen</h2>
      <div class="table-responsive">
                    <select class="btn btn-secondary dropdown-toggle btn-sm" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false" style="float: right">Pilih Program Studi
                          <ul class="dropdown-menu" aria-labelledby="dropdown03">
                            <li><option selected class="dropdown-item-dark" href="#">Semua</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Sipil</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Arsitektur</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Kimia</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Perencanaan Wilayah dan Kota</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Mesin</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Elektro</option></li> 
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Perkapalan</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Industri</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Lingkungan</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Geologi</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Geodesi</option></li>
                            <li><option value="1" class="dropdown-item-dark" href="#">Teknik Komputer</option></li>
                          </ul>
                    </select>
                    <a href="/tambah_kadep" class="">
                    <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right: 5px">Tambah Kadep</button>
                  </a>
                    <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nama Kadep</th>
              <th scope="col">NIP</th>
              <th scope="col">Program Studi</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($kadep as $kdp)
            <tr>
              <td>{{ $kdp->nama_kadep }}</td>
              <td>{{ $kdp->NIP }}</td>
              <td>{{ $kdp->prodi_kadep }}</td>
              <td>  <a href="/edit_kadep/{{ $kdp->id }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/hapus_kadep/{{ $kdp->id }}" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        
@endsection