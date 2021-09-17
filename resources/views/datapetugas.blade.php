@extends('admin.layouts.main')

@section('container')
                    <h2 class="mt-4">Data Petugas Penomoran</h2>
      <div class="table-responsive">
                    <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right: 5px">Tambah Petugas</button>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nama Petugas</th>
              <th scope="col">NIP</th>
              <th scope="col">E-mail Petugas</th>
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
