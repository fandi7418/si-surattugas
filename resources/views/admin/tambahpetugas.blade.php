@extends('admin.main')

@section('container')

<br>
<div class="card">
  <div class="card-header">
    <h2 class="card-title">Tambah Petugas Penomoran</h2>
  </div>
  <div class="card-body">
    <br>
    <p>Silahkan pilih Staff untuk dijadikan Petugas Penomoran</p>
    <table class="table table-striped table-bordered table-sm" id="datapetugas" style="width: 100%">
      <thead>
        <tr>
          <th scope="col">Nama Staff Dekanat FT</th>
          <th scope="col">NIP</th>
          <th scope="col">E-mail Staff</th>
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
                  $('#datapetugas').DataTable({
                      processing : true,
                      serverside : true,
                      ajax : {
                        url: "{{ route('tambah petugas') }}",
                        type: 'GET'
                      },
                      columns:[
                        {data:'nama', name:'nama'},
                        {data:'NIP', name:'NIP'},
                        {data:'email', name:'email'},
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
{{-- @extends('admin.main')

@section('container')

                    <h1 class="">Tambah Petugas Penomoran</h1>
                    <form method="post" action="/tambah_petugas" style="margin-right: 10px">
                        @csrf
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_petugas" value="{{ old('nama_petugas') }}" class="form-control @error('nama_petugas') is-invalid @enderror" id="colFormLabel"
                                    placeholder="Silahkan Masukkan Nama Anda">
                                        @error('nama_petugas')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{ old('NIP') }}" name="NIP"
                                    class="form-control @error('NIP') is-invalid @enderror" id="colFormLabel" placeholder="Silahkan Masukkan NIP Anda">
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
                                <input type="email" name="email_petugas" value="{{ old('email_petugas') }}" class="form-control @error('email_petugas') is-invalid @enderror" id="colFormLabel"
                                    placeholder="Silahkan Masukkan E-mail Anda">
                                        @error('email_petugas')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-5">
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="inputPassword"
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
                        </div>
                    </form>
            <script>
                            function myFunction() {
                                var x = document.getElementById("inputPassword");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                </script>
@endsection --}}