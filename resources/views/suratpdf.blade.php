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
		}
		table tr .text {
			/* text-align: center; */
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}

	</style>
</head>
<body>
	<center>
		<table>
			<tr>
				<td><img src="/undip.png" width="90" height="90"></td>
				<td>
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
					<font size="4"><b>No. {{ $surat->no_surat }}/XXXX/XXXX/2021</b></font><br>
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
				<td width="500">: {{ $surat->nama_dosen }}</td>
			</tr>
			<tr>
				<td>NIP</td>
				<td width="525">: {{ $surat->NIP }}</td>
			</tr>
			<tr>
				<td>Departemen/Prodi</td>
				<td width="525">: {{ $surat->prodi }}</td>
			</tr>
			<tr>
				<td>Pangkat/Golongan</td>
				<td width="525">: {{ $surat->pangkat }}</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td width="525">: {{ $surat->jabatan }}</td>
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
				<td width="541">: {{ $surat->jenis }}</td>
			</tr>
			<tr>
				<td width="150">Tempat Instansi Kegiatan</td>
				<td width="525">: {{ $surat->tempat }}</td>
			</tr>
			<tr>
				<td>Judul Kegiatan</td>
				<td width="525">: {{ $surat->judul }}</td>
			</tr>
			<tr>
				<td>Kota/Kabupaten</td>
				<td width="525">: {{ $surat->kota }}</td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td width="525">: {{ \Carbon\Carbon::parse($surat->tanggalawal)->isoFormat('dddd, D MMMM Y')}} s/d {{ \Carbon\Carbon::parse($surat->tanggalakhir)->isoFormat('dddd, D MMMM Y')}}</td>
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
				<td class="text" >Semarang, {{ \Carbon\Carbon::parse($surat->created_at)->isoFormat('D MMMM Y')}}</td>
			</tr>
	     </table>
		<table width="625">
			<tr>
				<td width="350"></td>
				<td class="text" >a.n Dekan</td>
			</tr>
			<tr>
				<td width="350">Kepala Departemen/Prodi</td>
				<td class="text" >Wakil Dekan Akademik dan Kemahasiswaan</td>
			</tr>
			<tr>
				<td class="text"><img src="/image/{{ $surat->ttd_kadep }}" alt="" width="auto" height="100px"></td>
				<td class="text"><img src="/image/{{ $surat->ttd_wd }}" alt="" width="auto" height="100px"></td>
			</tr>
			<tr>
				<td class="text">{{ $surat->nama_kadep }}</td>
				<td class="text">{{ $surat->nama_wd }}</td>
			</tr>
			<tr>
				<td class="text">NIP. {{ $surat->NIP_kadep }}</td>
				<td class="text">NIP. {{ $surat->NIP_wd }}</td>
			</tr>
	     </table>
	</center>

        <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        //do work
        window.print();
        });
        </script>
    </body>
</html>



