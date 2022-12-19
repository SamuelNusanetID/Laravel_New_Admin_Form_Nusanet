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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-success">
                                <h6 class="card-title">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Informasi {{ $titlePage }}
                                </h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="dataTableDataLayanan">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="align-middle text-center">Id</th>
                                            <th class="align-middle text-center">Name</th>
                                            <th class="align-middle text-center">Group</th>
                                            <th class="align-middle text-center">Download (Kbps)</th>
                                            <th class="align-middle text-center">Min. Download (Kbps)</th>
                                            <th class="align-middle text-center">Upload (Kbps)</th>
                                            <th class="align-middle text-center">Min. Upload (Kbps)</th>
                                            <th class="align-middle text-center">Support On-Site (hour)</th>
                                            <th class="align-middle text-center">Price</th>
                                            <th class="align-middle text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dataLayanan as $item)
                                            <tr>
                                                <td class="align-middle text-center">{{ $item->s_ServiceId }}</td>
                                                <td class="align-middle" style="text-align: justify;">
                                                    {{ $item->ServiceType }}</td>
                                                <td class="align-middle text-center">{{ $item->ServiceLevel }}</td>
                                                <td class="align-middle text-center">
                                                    {{ $item->NormalDownCeil != null ? $item->NormalDownCeil : '-' }}</td>
                                                <td class="align-middle text-center">
                                                    {{ $item->NormalDownRate != null ? $item->NormalDownRate : '-' }}</td>
                                                <td class="align-middle text-center">
                                                    {{ $item->NormalUpCeil != null ? $item->NormalUpCeil : '-' }}</td>
                                                <td class="align-middle text-center">
                                                    {{ $item->NormalUpRate != null ? $item->NormalUpRate : '-' }}</td>
                                                <td class="align-middle text-center">
                                                    {{ $item->DownTime != null ? $item->DownTime : '-' }}</td>
                                                <td class="align-middle text-center">
                                                    {{ 'Rp. ' . number_format($item->ServiceCharge, 2) }}</td>
                                                <td class="align-middle text-center">
                                                    {{ $item->discontinue == 0 ? 'Active' : 'Discontinue' }}</td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addonjs')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(`#dataTableDataLayanan`).DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });

            // Sweet Alert
            var isSuccessMessage = {!! json_encode(session()->has('successMessage')) !!}
            var isErrorMessage = {!! json_encode(session()->has('errorMessage')) !!}
            if (isSuccessMessage) {
                Swal.fire(
                    'Berhasil!',
                    {!! json_encode(session('successMessage')) !!},
                    'success'
                )
            } else if (isErrorMessage) {
                Swal.fire(
                    'Gagal!',
                    {!! json_encode(session('errorMessage')) !!},
                    'error'
                )
            }
        });
    </script>
@endsection
