@extends('admin.main')

@section('container')

                    <h2 class="mt-4">Data Surat</h2>
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
                                <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                            <th scope="col">No. Surat</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Nama Dosen</th>
                            <th scope="col">Program Studi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat as $srt )
                                    
                                <tr>
                                <td>{{ $srt->no_surat }}</td>
                                <td>{{ $srt->judul }}</td>
                                <td>{{ $srt->nama_dosen }}</td>
                                <td>{{ $srt->prodi->prodi }}</td>
                                <td>{{ \Carbon\Carbon::parse($srt->created_at)->isoFormat('D MMMM Y')}}</td>
                                <td>{{ $srt->status->status }}</td>
                            <td>
                                <a href="/surat/{{ $srt->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
                                <a href="/hapus_surat/{{ $srt->id }}/konfirmasiadmin" class="btn btn-danger btn-sm">Hapus</a>
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