@extends('admin.main')

@section('container')

<br>
<div class="card">
  <div class="card-header">
    <h2 class="card-title">Tambah Wakil Dekan</h2>
  </div>
  <div class="card-body">
    <br>
    <p>Silahkan pilih dosen untuk dijadikan Wakil Dekan</p>
    <table class="table table-striped table-bordered table-sm" id="datawd" style="width: 100%">
      <thead>
        <tr>
          <th scope="col">Nama Dosen</th>
          <th scope="col">NIP</th>
          <th scope="col">Program Studi</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
          {{-- <tbody>
            @foreach($kadep as $kdp)
            <tr>
              <td>{{ $kdp->nama_kadep }}</td>
              <td>{{ $kdp->NIP }}</td>
              <td>{{ $kdp->prodi->prodi }}</td>
              <td>  <a href="/edit_kadep/{{ $kdp->id }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/hapus_kadep/{{ $kdp->id }}/konfirmasi" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody> --}}
        
        
@endsection

@push('scripts')
        <script>
              $(document).ready(function() {
                  $('#datawd').DataTable({
                      processing : true,
                      serverside : true,
                      ajax : {
                        url: "{{ route('tambah wd') }}",
                        type: 'GET'
                      },
                      columns:[
                        {data:'nama', name:'nama'},
                        {data:'NIP', name:'NIP'},
                        {data:'prodi.prodi', name:'prodi.prodi'},
                        {
                            data: 'action', 
                            name: 'action', 
                            orderable: false, 
                            searchable: false
                        },
                      ],
                      order: [[0,'asc']]
                  });
              } );
          </script>
      @endpush
{{-- <form style="margin-right: 10px" method="POST" action="/tambah_wakildekan">
    @csrf
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-8">
            <input type="text" name="nama_wd" value="{{ old('nama_wd') }}"
                class="form-control @error('nama_wd') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan Nama Anda">
            @error('nama_wd')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-8">
            <input type="text" value="{{ old('NIP') }}" onkeypress="return event.charCode >= 48 && event.charCode <=57"
                name="NIP" class="form-control @error('NIP') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan NIP Anda">
            @error('NIP')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" name="email_wd" value="{{ old('email_wd') }}"
                class="form-control @error('email_wd') is-invalid @enderror" id="colFormLabel"
                placeholder="Silahkan Masukkan E-mail Anda">
            @error('email_wd')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-5">
            <input type="password" name="password" value="{{ old('password') }}"
                class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                placeholder="Silahkan Masukkan Password Anda">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <input type="checkbox" onclick="myFunction()"> Tampilkan Password
        </div>
    </div>
    <div class="form-group row mt-4">
        <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    </div> --}}