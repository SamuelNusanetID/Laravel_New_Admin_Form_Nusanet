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
                                @can('AuthMaster')
                                    <a href="{{ URL::to('data-promo/create') }}" class="btn btn-primary mb-3">
                                        <i class="fas fa-plus-circle me-1"></i>
                                        Tambah {{ $titlePage }}
                                    </a>
                                @endcan
                                <table class="table table-bordered" id="dataTableDataPromo" style="width: 100%;">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="align-middle text-center">No.</th>
                                            <th class="align-middle text-center">Kode Promo</th>
                                            <th class="align-middle text-center">Nama Paket</th>
                                            <th class="align-middle text-center">Jangka Waktu Pembayaran</th>
                                            <th class="align-middle text-center">Diskon (%)</th>
                                            <th class="align-middle text-center">Jumlah Bulan (Bulan)</th>
                                            <th class="align-middle text-center">Kriteria Promo</th>
                                            <th class="align-middle text-center">Tanggal Aktif Promo</th>
                                            <th class="align-middle text-center">Tanggal Berakhir Promo</th>
                                            @can('AuthMaster')
                                                <th class="align-middle text-center"></th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dataPromo as $item)
                                            <tr>
                                                <td class="align-middle text-center">{{ $i }}</td>
                                                <td class="align-middle text-center fw-bold">{{ $item->promo_name }}</td>
                                                <td class="align-middle">{{ $item->package_name }}</td>
                                                <td class="align-middle text-center">{{ $item->package_top }}</td>
                                                <td class="align-middle text-center">{{ $item->discount_cut }}</td>
                                                <td class="align-middle text-center">{{ $item->monthly_cut }}</td>
                                                <td class="align-middle text-center">{{ $item->monthly_cut_status }}</td>
                                                <td class="align-middle text-center">{{ $item->activate_date }}</td>
                                                <td class="align-middle text-center">{{ $item->expired_date }}</td>
                                                @can('AuthMaster')
                                                    <td class="align-middle text-center">
                                                        <a href="{{ URL::to('data-promo/' . $item->id . '/edit') }}"
                                                            class="btn btn-warning text-white">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ URL::to('data-promo/' . $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt me-1"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endcan
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
            $(`#dataTableDataPromo`).DataTable({
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
