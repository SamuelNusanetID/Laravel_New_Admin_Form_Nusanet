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
                @can('AuthMaster')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Statistik Pelanggan Baru</h3>
                                        <h3 class="card-title">Tanggal : {{ date('d-m-Y') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">{{ $jumlahPelangganBaru }}</span>
                                            <span>Total Pelanggan Baru</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->

                                    <div class="position-relative mb-4">
                                        <canvas id="new-customer-chart" height="80"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Statistik Pelanggan Baru Yang Masuk Ke IS</h3>
                                        <h3 class="card-title">Tanggal : {{ date('d-m-Y') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">{{ $jumlahPelangganApproved }}</span>
                                            <span>Total Pelanggan Baru Yang Masuk Ke IS</span>
                                        </p>
                                    </div>
                                    <!-- /.d-flex -->

                                    <div class="position-relative mb-4">
                                        <canvas id="is-customer-chart" height="80"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">List Promo Yang Sedang Aktif</h3>
                                        <h3 class="card-title">Tanggal : {{ date('d-m-Y') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="dataTablesDashboard">
                                        <thead class="bg-success">
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Promo</th>
                                                <th>Nama Paket</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($dataPromo as $item)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item->promo_code }}</td>
                                                    <td>{{ $item->package_name }}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->
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
    @can('AuthMaster')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
        <!--Chart.js JS CDN-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script>
            $(document).ready(() => {
                $(`#dataTablesDashboard`).DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                });

                var today = new Date();
                var labelGraph = [];
                getDaysInMonth(today.getMonth(), today.getFullYear()).forEach(element => {
                    labelGraph.push(element.getDate());
                });

                // Get Data Pelanggan Baru
                var getDataPelangganBaru = {!! json_encode($dataPelangganBaru) !!}
                var dataPelangganBaru = [];
                getDataPelangganBaru.forEach(element => {
                    element.created_at = new Date(element.created_at);
                    dataPelangganBaru.push(element.created_at.getDate());
                });

                var filterDataPelangganBaru = jumlahDataPelangganBaru(dataPelangganBaru);
                var labelyValuesNewCS = [];
                labelGraph.forEach(element => {
                    if (typeof filterDataPelangganBaru[element] !== 'undefined') {
                        labelyValuesNewCS.push(filterDataPelangganBaru[element]);
                    } else {
                        labelyValuesNewCS.push(0);
                    }
                })

                // Statistik untuk pelanggan baru
                var xValues = labelGraph;
                var yValues = labelyValuesNewCS;

                var ctx = document.getElementById('new-customer-chart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: xValues,
                        datasets: [{
                            data: yValues,
                            borderColor: "rgb(62,149,205)",
                            backgroundColor: "rgb(62,149,205,0.1)",
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        tooltips: {
                            enabled: false
                        }
                    }
                });

                // Get Data Pelanggan IS
                var getDataPelangganIS = {!! json_encode($dataPelangganApproved) !!}
                var dataPelangganIS = [];
                getDataPelangganIS.forEach(element => {
                    element.created_at = new Date(element.created_at);
                    dataPelangganIS.push(element.created_at.getDate());
                });

                var filterDataPelangganIS = jumlahDataPelangganBaru(dataPelangganIS);
                var labelyValuesISCS = [];
                labelGraph.forEach(element => {
                    if (typeof filterDataPelangganIS[element] !== 'undefined') {
                        labelyValuesISCS.push(filterDataPelangganIS[element]);
                    } else {
                        labelyValuesISCS.push(0);
                    }
                })

                // Statistik untuk pelanggan baru IS
                var xValues = labelGraph;
                var yValues = labelyValuesISCS;

                var ctx = document.getElementById('is-customer-chart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: xValues,
                        datasets: [{
                            data: yValues,
                            borderColor: "rgb(62,149,205)",
                            backgroundColor: "rgb(62,149,205,0.1)",
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        tooltips: {
                            enabled: false
                        }
                    }
                });
            });

            function jumlahDataPelangganBaru(arrayDataPelangganBaru) {
                var counts = {};

                for (var i = 0; i < arrayDataPelangganBaru.length; i++) {
                    var key = arrayDataPelangganBaru[i];
                    counts[key] = (counts[key]) ? counts[key] + 1 : 1;
                }

                return counts;
            }

            function getDaysInMonth(month, year) {
                var date = new Date(year, month, 1);
                var days = [];
                while (date.getMonth() === month) {
                    days.push(new Date(date));
                    date.setDate(date.getDate() + 1);
                }
                return days;
            }
        </script>
    @endcan
@endsection
