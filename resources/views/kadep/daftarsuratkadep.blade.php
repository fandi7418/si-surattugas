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
            <tr>
              <td> </td>
              <td> </td>
              <td> </td>
              <td>
              <button type="button" class="btn btn-secondary btn-sm">Lihat</button>
              <button type="button" class="btn btn-danger btn-sm">Tolak</button>
              <button type="button" class="btn btn-success btn-sm">Izinkan</button>
              </td>
            </tr>
            <tr>
              <td> </td>
              <td> </td>
              <td> </td>
              <td>
              <button type="button" class="btn btn-secondary btn-sm">Lihat</button>
              <button type="button" class="btn btn-danger btn-sm">Tolak</button>
              <button type="button" class="btn btn-success btn-sm">Izinkan</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

@endsection