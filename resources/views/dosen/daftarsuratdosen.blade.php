@extends('dosen.main')

@section('dosen')
<title>Daftar Surat</title>

        <h2>Daftar Surat</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No. Surat</th>
              <th scope="col">Nama Surat</th>
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
              <td>{{ \Carbon\Carbon::parse($isi->created_at)->isoFormat('D MMMM Y')}}</td>
              <td>{{$isi->status}}</td>
              <td>
                <a href="/surat/{{ $isi->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
                <a href="/editsurat/{{ $isi->id }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="/hapussurat/{{ $isi->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        {{ $surat->links() }}
        </ul>
      </nav>


@endsection