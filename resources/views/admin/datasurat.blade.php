@extends('admin.main')

@section('container')
<br>
<div class="card">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card-header">
        <h2 class="card-title">Data Surat</h2>
    </div>
    <div class="card-body">
        <a href="/data_surat/trash" class="btn btn-danger btn-sm">Sampah</a>
        <br>
        <br>
        <table class="table table-striped table-bordered table-sm" id="datasurat" style="width: 100%">
            <thead>
                <tr style="text-align:center">
                    <th scope="col">No. Surat</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col" style="display: none">id</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surat as $srt )
                <tr>
                    <td>{{ $srt->no_surat }}</td>
                    <td>{{ $srt->judul }}</td>
                    <td>{{ $srt->nama }}</td>
                    @if(isset($srt->prodi_id))
                    <td>{{ $srt->prodi->prodi }}</td>
                    @else
                    <td style="color:rgb(0, 64, 255)">Teknik</td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($srt->created_at)->isoFormat('D MMMM Y')}}</td>
                    <td style="display: none">{{ $srt->id }}</td>
                    <td>{{ $srt->status->status }}</td>
                    <td>
                        <a href="/surat/{{ $srt->id }}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a>
                        {{-- @if ($srt->status_id == '1')
                        <button type="button" class="btn btn-success btn-sm" onClick="konfirmasikadep({{ $srt->id }})">Izinkan</button> --}}
                        {{-- <form enctype="multipart/form-data" style="float: left" method="post" action="{{ url('postizinkankadep/'. $srt->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">izin</button>
                            </form> --}}
                        {{-- <a  method="post" href="postizinkankadep/{{ $srt->id }}" class="btn btn-success btn-sm">izinkan</a> --}}
                        {{-- @elseif ($srt->status_id == '2')
                        <button type="button" class="btn btn-success btn-sm" onClick="konfirmasiwd({{ $srt->id }})">Izinkan</button> --}}
                        {{-- <form enctype="multipart/form-data" method="post" action="{{ url('postizinkanwakildekan/'. $srt->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">izin</button>
                            </form> --}}
                        {{-- @endif --}}
                        <a href="/hapus_surat/{{ $srt->id }}/konfirmasiadmin" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection
</tbody>
<!-- Modal Konfirmasi izin Kadep -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeBtn">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" name="modal-body">
            Anda akan menyetujui surat?
                <input type="text" readonly class="form-control" style="display: none" id="ttd_kadep" name="ttd_kadep">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-success" id="confirmBtn" onclick="izinSuratkadep()">OK</button>
            </div>
        </div>
        </div>
    </div>

<!-- Modal Konfirmasi izin Wakil Dekan -->
    <div class="modal fade" id="confirmModalwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeBtnwd">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" name="modal-bodywd">
            Anda akan menyetujui surat?
                <input type="text" readonly class="form-control" style="display: none" id="ttd_wd" name="ttd_wd">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-success" id="confirmBtnwd" onclick="izinSuratkadep()">OK</button>
            </div>
        </div>
        </div>
    </div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#datasurat').DataTable({
            order: [
                [5, 'desc']
            ]
        });
    });


//Izin Surat dengan TTD Kadep
    function konfirmasikadep(id)
{
    let seturl = "{{ route("confirmIzinkadep", ":id") }}";
    seturl = seturl.replace(':id', id);

    console.log(seturl);
    $.get(seturl, function(data){
        console.log(data);
        $('#confirmBtn').attr('onclick', `izinSuratkadep(${data.surat.id})`);
        $("#confirmModal").modal('show');
        $("#ttd_kadep").val(data.kadep[0].ttd_kadep);
    });
    $('#closeBtn').click(function(){
        $("#confirmModal").modal('hide');
        });
    }

    function izinSuratkadep(id) {
    var ttd_kadep = $("#ttd_kadep").val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('izinkankadepadmin') }}"+'/'+id,
        type: "POST",
        data: {
        ttd_kadep: ttd_kadep,
        },
        dataType: 'json',
        success: function (data) {
        $("#confirmModal").modal('hide');
            window.location.reload(true);
        },
        error: function(err) {
        console.log(err.responseJSON);
        let err_log = err.responseJSON.errors;
        if (err.status == 422){
            $('#confirmModal').find('[name="modal-body"]')
            .html('<span style="color:red">'+err_log.ttd_kadep[0]+'</span>')
        }
        $('#confirmBtn').click(function(){
            $("#confirmModal").modal('hide');
            window.location.reload(true);
        });
        }
    });
}
//Izin Surat dengan TTD Wakil Dekan
    function konfirmasiwd(id)
{
    let seturl = "{{ route("confirmIzinwd", ":id") }}";
    seturl = seturl.replace(':id', id);

    console.log(seturl);
    $.get(seturl, function(data){
        console.log(data);
        $('#confirmBtnwd').attr('onclick', `izinSuratwd(${data.surat.id})`);
        $("#confirmModalwd").modal('show');
        $('#ttd_wd').val(data.wd[0].ttd_wd);
    });
    $('#closeBtnwd').click(function(){
        $("#confirmModalwd").modal('hide');
        });
    }

    function izinSuratwd(id) {
    var ttd_wd = $("#ttd_wd").val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('izinkanwdadmin') }}"+'/'+id,
        type: "POST",
        data: {
        ttd_wd: ttd_wd,
        },
        dataType: 'json',
        success: function (data) {
        $("#confirmModalwd").modal('hide');
            window.location.reload(true);
        },
        error: function(err) {
        console.log(err.responseJSON);
        let err_log = err.responseJSON.errors;
        if (err.status == 422){
            $('#confirmModalwd').find('[name="modal-bodywd"]')
            .html('<span style="color:red">'+err_log.ttd_wd[0]+'</span>')
        }
        $('#confirmBtnwd').click(function(){
            $("#confirmModalwd").modal('hide');
            window.location.reload(true);
        });
        }
    });
}
</script>
@endpush
