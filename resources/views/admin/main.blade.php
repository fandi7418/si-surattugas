<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="M. Gesit Alifandi" />
        <title>{{$title}} | Sistem Informasi Surat Tugas</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <!-- CSS only -->
        <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
        <link href="{{ asset('css/adminstyles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/adminsidebars.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Universitas Diponegoro</div>
                <div  class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/dashboard_admin">Dashboard</a>
                    <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Pengguna</a> -->
                    <button class="nav-link dropdown-toggle list-group-item list-group-item-action list-group-item-light p-3" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                        Pengguna
                        </button>
                        <div class="collapse show" id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li ><a href="/data_admin" class="link-dark rounded">Admin</a></li>
                                <li><a href="/data_dosen" class="link-dark rounded">Dosen</a></li>
                                <li><a href="/data_kadep" class="link-dark rounded">Ketua Departemen</a></li>
                                <li><a href="/data_wakildekan" class="link-dark rounded">Wakil Dekan</a></li>
                                <li><a href="/data_petugas" class="link-dark rounded">Petugas Penomoran</a></li>
                            </ul>
                        </div>
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/data_surat">Data Surat</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            
                                            <a class="dropdown-item"  href="{{ route('logout') }}" >Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                    <div class="container-fluid">
                        @yield('container')
                        
                    </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        {{-- <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js') }}"></script> --}}
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js') }}" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

        <!-- Core theme JS-->
        <script src="{{ asset('js/adminscripts.js') }}"></script>
        {{-- alert peringatan --}}
        {{-- <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.slim.js') }}" type="text/javascript" defer integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script> --}}
        {{-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> --}}

        {{-- <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js') }}"></script> --}}
        @include('sweetalert::alert')

    </body>
</html>
