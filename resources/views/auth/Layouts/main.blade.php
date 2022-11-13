<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ URL::to('plugin/bs522/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('bin/css/style.css') }}">

    <title>Admin Form | {{ $titlePage }}</title>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="container-fluid">
            <div class="text-center">
                <div class="d-flex align-items-center justify-content-center mb-5">
                    <div class="wrapper-image" style="box-shadow: 5px 6px rgba(0,0,0,.2);">
                        <img class="img-fluid" src="{{ URL::to('bin/img/0DaWevkh_400x400-removebg-preview.png') }}"
                            alt="" width="80" height="80">
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-center">
                    <div class="card bg-white" style="width: 25em;">
                        <div class="card-body text-start">
                            <h3 class="fw-bold text-center text-success">{{ $headerCard }}</h3>
                            @yield('auth-wrapper')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ URL::to('plugin/bs522/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
