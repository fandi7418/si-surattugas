<!doctype html>
<html>


<head>
<title>Surat Izin Tugas</title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
			z-index: 1;
		}
		table tr .text {
			/* text-align: center; */
			font-size: 13px;
			/* z-index: 1; */
		}
		table tr td {
			font-size: 13px;
		}

		.ttdWD {
			position: relative;
		}
		.cap {
			bottom: 210px;
			right: 250px;
			position: absolute;
		}

		/* table tr #cap{
			z-index: 2;
		} */
	</style>
</head>
<body>
	<center>
		<table>
			<tr>
				<td><img src="/undip.png" width="90" height="90"></td>
				<td>
					
				@foreach($surat as $srt)

				<center>
					<font size="4">KEMENTRIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</font><br>
					<font size="4">UNIVERSITAS DIPONEGORO</font><br>
					<font size="4"><b>FAKULTAS TEKNIK</b></font><br>
					<font size="2">Jl. Prof. H. Soedarto,SH. Tembalang – Semarang, Kode Pos 50275 Telp. (+6224)</font><br>
					<font size="2">7460053, 7460055 Fax. (+6224) 7460055</font><br>
					<font size="2">Site: http://www.ft.undip.ac.id – Email : teknik@undip.ac.id</font><br>
					<!-- <font size="2"><i></i></font> -->
				</center>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
		<!-- <table width="625">
			<tr>
				<td class="text2"> 16 mei 2019</td>
			</tr>
		</table> -->
		</table>
        <table>
			<tr>
				<td>
				<center>
					<font size="4"><b>SURAT TUGAS</b></font><br>
					<font size="4"><b>No. {{ $srt->no_surat }}</b></font><br>
				</center>
				</td>
			</tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Dekan Fakultas Teknik Universitas Diponegoro dengan ini memberi izin kepada :</font>
		       </td>
		    </tr>
		</table>
		<table width="625">
			<tr class="text2">
				<td width="150">Nama</td>
				<td width="500">: {{ $srt->nama }}</td>
			</tr>
			<tr>
				<td>NIP</td>
				<td width="525">: {{ $srt->NIP }}</td>
			</tr>
			@if(isset($srt->prodi_id))
			<tr>
				<td>Departemen/Prodi</td>
				@if($srt->approve == '1' || $srt->approve == '2')
					<td width="525">: {{ $srt->prodi_id }}</td>
				@else
					<td width="525">: {{ $srt->prodi->prodi }}</td>
				@endif
			</tr>
			@endif
			<tr>
				<td>Pangkat/Golongan</td>
				@if($srt->approve == '1' || $srt->approve == '2')
					<td width="525">: {{ $srt->golongan_id }}</td>
				@else
					<td width="525">: {{ $srt->golongan->nama_golongan }}</td>
				@endif
			</tr>
			<tr>
				<td>Jabatan</td>
				@if($srt->approve == '1' || $srt->approve == '2')
					<td width="525">: {{ $srt->jabatan_id }}</td>
				@else
					<td width="525">: {{ $srt->jabatan->nama_jabatan }}</td>
				@endif
			</tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Untuk melaksanakan kegiatan sebagai berikut :</font>
		       </td>
		    </tr>
		</table>

		<table width="625">
			<tr class="text2">
				<td>Nama Kegiatan</td>
				<td width="541">: {{ $srt->jenis }}</td>
			</tr>
			<tr>
				<td width="150">Tempat Instansi Kegiatan</td>
				<td width="525">: {{ $srt->tempat }}</td>
			</tr>
			<tr>
				<td>Judul Kegiatan</td>
				<td width="525">: {{ $srt->judul }}</td>
			</tr>
			<tr>
				<td>Kota/Kabupaten</td>
				<td width="525">: {{ $srt->kota }}</td>
			</tr>
			<tr>
				<td>Tanggal</td>
				@if($srt->tanggalawal == $srt->tanggalakhir)
				<td width="525">: {{ \Carbon\Carbon::parse($srt->tanggalawal)->isoFormat('dddd, D MMMM Y')}}</td>
				@else
				<td width="525">: {{ \Carbon\Carbon::parse($srt->tanggalawal)->isoFormat('dddd, D MMMM Y')}} s/d {{ \Carbon\Carbon::parse($srt->tanggalakhir)->isoFormat('dddd, D MMMM Y')}}</td>
				@endif
			</tr>
		</table>
        <br>
        <table width="625">
			<tr>
		       <td>
			       <font size="2">Demikian Surat Tugas ini dibuat untuk dapat dilaksanakan dengan 
                       sebaik-baiknya, dan yang bersangkutan wajib memberikan laporan kepada Dekan
                       setelah selesai.
                   </font>
		       </td>
		    </tr>
		</table>
        <br>
        <br>
		<table width="625">
			<tr>
				<td width="350"></td>
				<td class="text" >Semarang, {{ \Carbon\Carbon::parse($srt->created_at)->isoFormat('D MMMM Y')}}</td>
			</tr>
	     </table>
		<table width="625">
			<tr>
				<td width="350"></td>
				<td class="text" >a.n Dekan</td>
			</tr>
			<tr>
				<!-- @if(isset($srt->nama_kadep))
				<td width="350">Ketua Departemen/Prodi</td>
				@else
				<td width="350">Supervisor</td>
				@endif -->
				<td width="350"></td>
				<td class="text" >Wakil Dekan Akademik dan Kemahasiswaan</td>
			</tr>
			<tr>
				<!-- @if(isset($srt->ttd_kadep))
				<td class="text"><img src="/image/{{ $srt->ttd_kadep }}" alt="" width="auto" height="100px"></td>
				@else
				<td class="text"><img src="/image/{{ $srt->ttd_spv }}" alt="" width="auto" height="100px"></td>
				@endif -->
				<td width="350"></td>
				<td class="ttdWD" id="ttdWD"><img src="/image/{{ $srt->ttd_wd }}" alt="" width="auto" height="100px"></td>
				@if($srt->status_id == '4')
				<td class="cap" id="cap"><img src="/CapUndip.png" alt="" width="auto" height="170px"></td>
				@endif
			</tr>
			<tr>
			@if($srt->approve == '1' || $srt->approve == '2')
				<!-- @if(isset($srt->nama_kadep))
					<td class="text">{{ $srt->nama_kadep }}</td>
				@else
					<td class="text">{{ $srt->nama_supervisor }}</td>
				@endif -->
					<td width="350"></td>	
					<td class="text">{{ $srt->nama_wd }}</td>
			@else
				<!-- @if(isset($srt->nama_kadep))
					@foreach($kadep as $kdp)
						<td class="text">{{ $kdp->nama }}</td>
					@endforeach
				@else
					@foreach($supervisor as $spv)
						<td class="text">{{ $spv->nama }}</td>
					@endforeach
				@endif -->
				@foreach($wd as $wd1)
					<td width="350"></td>	
					<td class="text">{{ $wd1->nama }}</td>
				@endforeach
			@endif
			</tr>
			<tr>
			@if($srt->approve == '1' || $srt->approve == '2')
				<!-- @if(isset($srt->NIP_kadep))
					<td class="text">NIP. {{ $srt->NIP_kadep }}</td>
				@else
					<td class="text">NIP. {{ $srt->NIP_supervisor }}</td>
				@endif -->
					<td width="350"></td>
					<td class="text">NIP. {{ $srt->NIP_wd }}</td>
			@else
				<!-- @if(isset($srt->NIP_kadep))
					@foreach($kadep as $kdp)
						<td class="text">NIP. {{ $kdp->NIP }}</td>
					@endforeach
				@else
					@foreach($supervisor as $spv)
						<td class="text">NIP. {{ $spv->NIP }}</td>
					@endforeach
				@endif -->
				@foreach($wd as $wd1)
					<td width="350"></td>
					<td class="text">NIP. {{ $wd1->NIP }}</td>
				@endforeach
			@endif
			</tr>
	     </table>
		 @endforeach
	</center>

        <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        //do work
        window.print();
        });
        </script>
    </body>
</html>



