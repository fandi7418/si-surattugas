<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>SIKEPO v2.0</title>

    <link rel="canonical" href="{{ asset('https://getbootstrap.com/docs/5.1/examples/sign-in/') }}">



    <!-- Bootstrap core CSS -->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">


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
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body class="text-center">




    <main class="form-signin">
      
        <form action="{{ route('postlogin') }}" method="post">
            @csrf
            <!-- <img class="mb-4" src="/undip.png" alt="" width="auto" height="150"> -->
            <img class="mb-4" src="/LogoSikepo.png" alt="" width="auto" height="250">
            <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com"
                    autofocus required>
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                    required>
                <label for="password">Password</label>
            </div>
            <div>
                <button class="btn btn-lg btn-primary" type="submit">Login</button>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
</body>

</html>

