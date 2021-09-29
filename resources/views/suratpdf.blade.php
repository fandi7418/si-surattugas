<!doctype html>
<html>
    <head>

    </head>
    <body>
        <h1>Nama dosen = {{ $surat->nama_dosen }}</h1>
        <h1>NIP = {{ $surat->NIP }}</h1>
        <h1>No. Surat = {{ $surat->no_surat }}</h1>
        <h1>Judul Surat = {{ $surat->judul }}</h1>
        <h1>Jenis Kegiatan = {{ $surat->jenis }}</h1>
        <h1>Tempat = {{ $surat->tempat }}</h1>
        <script>
        // $(document).ready(function() {
        // window.print();
        // })
        document.addEventListener("DOMContentLoaded", function(event) {
        //do work
        window.print();
        });
        </script>
    </body>
</html>



