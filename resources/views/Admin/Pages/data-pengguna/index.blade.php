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
                                <table class="table table-bordered" id="dataTableDataPengguna" style="width: 100%;">
                                    <thead class="bg-success">
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Karyawan</th>
                                            <th>Nama Karyawan</th>
                                            <th>Email Karyawan</th>
                                            <th>Pimpinan Divisi</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dataPengguna as $item)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item->employee_id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->password }}</td>
                                                <td></td>
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
            $(`#dataTableDataPengguna`).DataTable({
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
                    'Data pelanggan telah berhasil diajukan',
                    'success'
                )
            } else if (isErrorMessage) {
                Swal.fire(
                    'Gagal!',
                    'Data pelanggan gagal diajukan',
                    'error'
                )
            }
        });
    </script>
@endsection
