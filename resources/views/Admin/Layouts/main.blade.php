<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Form | {{ $titlePage }}</title>

    @yield('addoncss')
    <!-- Bootstrap 5.2 CSS -->
    <link rel="stylesheet" href="{{ URL::to('plugin/bs522/css/bootstrap.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::to('plugin/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('plugin/adminlte/dist/css/adminlte.min.css') }}">
    <!-- Test style -->
    <link rel="stylesheet" href="{{ URL::to('bin/css/style.css') }}">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('Admin.Partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Admin.Partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content-wrapper')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('Admin.Partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ URL::to('plugin/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::to('plugin/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('plugin/bs522/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ URL::to('plugin/adminlte/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ URL::to('plugin/adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    {{-- <!-- AdminLTE for demo purposes --> --}}
    {{-- <script src="{{ URL::to('plugin/adminlte/dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::to('plugin/adminlte/dist/js/pages/dashboard3.js') }}"></script>

    @yield('addonjs')

    {{-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        $('#decisionBtnYesFeedback').on('click', () => {
            $('#firstModal').modal('hide');
            $('#secondModal').modal('show');
            // const screenshotTarget = document.body;

            // html2canvas(screenshotTarget).then((canvas) => {
            //     // Get Date Now
            //     const today = new Date();
            //     const yyyy = today.getFullYear();
            //     let mm = today.getMonth() + 1; // Months start at 0!
            //     let dd = today.getDate();

            //     if (dd < 10) dd = '0' + dd;
            //     if (mm < 10) mm = '0' + mm;

            //     const formattedToday = dd + '_' + mm + '_' + yyyy + '-' + today.getHours() + ':' + today
            //         .getMinutes() + ':' + today.getSeconds();

            //     const url = canvas.toDataURL("image/png");
            // });
        });
    </script> --}}
</body>

</html>
