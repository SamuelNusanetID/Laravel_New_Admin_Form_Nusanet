<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Form | {{ $titlePage }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::to('plugin/hopeui/assets/images/favicon.ico') }}" />
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ URL::to('plugin/hopeui/assets/css/core/libs.min.css') }}" />
    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ URL::to('plugin/hopeui/assets/css/hope-ui.min.css?v=1.2.0') }}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ URL::to('plugin/hopeui/assets/css/custom.min.css?v=1.2.0') }}" />
    <!-- Dark Css -->
    <link rel="stylesheet" href="{{ URL::to('plugin/hopeui/assets/css/dark.min.css') }}" />
    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{ URL::to('plugin/hopeui/assets/css/customizer.min.css') }}" />
    <!-- RTL Css -->
    <link rel="stylesheet" href="{{ URL::to('plugin/hopeui/assets/css/rtl.min.css') }}" />
</head>

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-light vh-100">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @yield('auth-wrapper')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Library Bundle Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/core/libs.min.js') }}"></script>
    <!-- External Library Bundle Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/core/external.min.js') }}"></script>
    <!-- Widgetchart Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/charts/widgetcharts.js') }}"></script>
    <!-- mapchart Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/charts/vectore-chart.js') }}"></script>
    <script src="{{ URL::to('plugin/hopeui/assets/js/charts/dashboard.js') }}"></script>
    <!-- fslightbox Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/plugins/fslightbox.js') }}"></script>
    <!-- Settings Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/plugins/setting.js') }}"></script>
    <!-- Slider-tab Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/plugins/slider-tabs.js') }}"></script>
    <!-- Form Wizard Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/plugins/form-wizard.js') }}"></script>
    <!-- AOS Animation Plugin-->
    <!-- App Script -->
    <script src="{{ URL::to('plugin/hopeui/assets/js/hope-ui.js') }}" defer></script>
</body>

</html>
