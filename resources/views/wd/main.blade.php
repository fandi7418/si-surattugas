<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">


    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbars/">

    

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->
    <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="/css/navbar.css" rel="stylesheet">
    <link href="/css/sidebars.css" rel="stylesheet">
  </head>

   <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">

      <a class="navbar-brand" href="/dashboardkadep">
      <img src="/undip.png" alt="" width="auto" height="32">
      Universitas Diponegoro</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarsExample02">
      <ul class="navbar-nav ml-auto">
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="position-absolute start-100 translate-middle" id="angkaNotif" name="angkaNotif">
                      
                    </div>  
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                      <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                    </svg>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Notifikasi</th>
                        </tr>
                      </thead>
                    </table>
                    
                      <li>
                        <div class="scrollable-menu">
                          <table class="table" style="width: 500px">
                            <tbody id="isiNotif">
                              <!-- isi tabel notif -->
                            </tbody>
                          </table>
                        </div>
                      </li>
                  </ul>
                </li>
              </ul>
          </div>
          <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person-circle" style="margin-right:5px"></i>  
                @if ( Str::length(Auth::guard('pengguna')->user()) >0 )
                  {{ Auth::guard('pengguna')->user()->nama }}
                @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/profilwd" style="margin-bottom:5px">
                      <i class="bi bi-pencil-square" style="margin-right:10px"></i>
                      Edit Profil
                    </a>
                    <a class="dropdown-item" href="/logout">
                      <i class="bi bi-box-arrow-left" style="margin-right:10px"></i>
                      Logout
                    </a>
                </div>
            </li>
          </ul>
        </ul>
      </div>

  </nav>

<body>


<main>
  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: auto;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    </a>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="/dashboardwd" class="nav-link text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16" style="margin-right: 10px">
          <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
        </svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="/daftarsuratwd" class="nav-link text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16" style="margin-right: 10px">
          <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
          <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
          <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
        </svg>
          Daftar Surat
        </a>
      </li>

      <hr>
        <li>
          <a href="/dashboarddosen" class="nav-link text-white" id="angkaNotifDosen" name="angkaNotifDosen">
            Menu Dosen
          </a>
        </li>
    </ul>
  </div>

        <!-- Isi -->
  <div class="col-lg-10" style="margin-left: 20px; margin-top: 20px">
        @yield('wd')
  </div>
</main>

    <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>-->

    <script src="/js/sidebars.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    @include('sweetalert::alert')
    @yield('WakilDekan_js')
    <script>
      var time = new Date().getTime();
      $(document.body).bind("mousemove keypress", function () {
          time = new Date().getTime();
      });

      setInterval(function() {
          if (new Date().getTime() - time >= 900000) {
              window.location.reload(true);
          }
      }, 900000);
      $(document).ready(function(){
        notif();
      });
      function notif(){
        let seturl = "{{ route("notifWD") }}";
        console.log(seturl);
          
          $.ajax({
              url: seturl,
              type: "GET",
              dataType: 'json',
              success: function (data) {
                $("#isiNotif").empty();
                $("#angkaNotif").empty();
                $("#angkaNotifDosen").html(`Menu Dosen`);
                for (var i=0; i < data.surat.length; i++){
                  var waktu = new Date(data.surat[i].updated_at);
                  var jam = waktu.getHours();
                  var menit = waktu.getMinutes();

                  $("#isiNotif").append(
                    `<tbody>
                        <tr>
                          <td class="align-middle" scope="row" style="height: auto; width: 500px; margin-left:5px; margin-right:5px">
                            <div style="height: auto; width: 480px; margin-left:10px;">
                              Anda belum menyetujui surat dari `+data.surat[i].nama+` dengan judul "`+data.surat[i].judul+`"
                              <br>
                              <br>
                                <small style="float: right">
                                  `+jam+`:`+menit+` WIB
                                </small>
                            </div>
                          </td>
                        </tr>
                      </tbody>`
                  );
                  $("#angkaNotif").html(
                    '<span class=" badge rounded-pill bg-danger">'+data.surat.length+''
                  );
                }
                if(data.dosen.length != '0'){
                  $("#angkaNotifDosen").html(
                    `Menu Dosen <span class=" badge rounded-pill bg-danger">`+data.dosen.length+``
                  );
                }else{
                  $("#angkaNotifDosen").html(
                    `Menu Dosen`
                  );
                }
              }
            });
          setTimeout(notif, 2000);
      }
    </script>
  </body>
</html>
