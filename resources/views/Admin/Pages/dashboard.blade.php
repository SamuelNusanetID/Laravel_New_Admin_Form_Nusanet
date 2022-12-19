@extends('Admin.Layouts.main')

@section('addoncss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
@endsection

@section('content-wrapper')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $titlePage }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">{{ $titlePage }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card shadow border mb-3">
                    <div class="card-body">
                        <h3 class="text-success fw-bold mb-3">Selamat Datang, {{ auth()->user()->name }}</h3>
                        <p>
                            Admin Dashboard ini digunakan untuk mengelola data pelanggan baru ataupun pelanggan yang telah
                            terdaftar ke IS.
                        </p>
                    </div>
                </div>
                @can('AuthSales')
                    <div class="card shadow border mb-3">
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-describedby="button-addonsales"
                                    id="linkURLSales"
                                    value="{{ env('APP_URL_FORM') . '/new-member?am=' . auth()->user()->employee_id }}"
                                    disabled>
                                <button class="btn btn-success" type="button" id="button-addonsales"
                                    onclick="copyToClipboard('#linkURLSales')">Copy</button>
                            </div>
                        </div>
                    </div>
                @endcan
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('addonjs')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).val()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
@endsection
