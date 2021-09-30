@extends('admin.main')

@section('container')
                    <h2 class="mt-4">Data Wakil Dekan</h2>
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
                    
                    <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right: 5px">Tambah Kadep</button>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nama Wakil Dekan</th>
              <th scope="col">NIP</th>
              <th scope="col">Email</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td><button type="button" class="btn btn-primary btn-sm">Edit</button>
              <button type="button" class="btn btn-danger btn-sm">Hapus</button>
            </td>
            </tr>
            
          </tbody>
        </table>
      </div>
        
@endsection