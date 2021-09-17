@extends('admin.layouts.main')

@section('container')
                    <h2 class="mt-4">Data Admin</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nama Admin</th>
              <th scope="col">NIP</th>
              <th scope="col">E-mail Admin</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button href="/edit_admin" type="button" class="btn btn-primary btn-sm">Edit</button>
              </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button type="button" class="btn btn-primary btn-sm">Edit</button>
              </td>
              </tr>
              
            </tbody>
        </table>
      </div>

      
      @endsection