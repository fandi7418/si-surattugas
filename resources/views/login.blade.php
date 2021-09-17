
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Halaman Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="/front/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="login.css" rel="stylesheet">
  </head>
    <body class="text-center">
  
<main class="form-signin">
  <form action="/" method="post">
      @csrf
    <img class="mb-4" src="logoundip.png" alt="" width="auto" height="150">
    <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" autofocus required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
      <!-- <input type="checkbox" onclick="myFunction()"> Tampilkan Password
<script>
                            function myFunction() {
                                var x = document.getElementById("floatingPassword");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                </script> -->
    </div>

    <div class="mb-4">
      
    </div>
    <button href="/dashboard_admin" class="btn btn-lg btn-primary" type="submit">Login</button>
 
  </form>
</main>


  </body>
</html>
