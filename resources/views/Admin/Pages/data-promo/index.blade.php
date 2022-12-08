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
                                <table class="table table-bordered" id="dataTableDataPromo" style="width: 100%;">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="align-middle text-center">ID</th>
                                            <th class="align-middle text-center">Promo</th>
                                            <th class="align-middle text-center">Branch</th>
                                            <th class="align-middle text-center">Tanggal Mulai</th>
                                            <th class="align-middle text-center">Tanggal Berakhir</th>
                                            <th class="align-middle text-center">Deskripsi</th>
                                            <th class="align-middle text-center">Status</th>
                                            <th class="align-middle text-center">Created at</th>
                                            <th class="align-middle text-center">Create by</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dataPromo as $item)
                                            <tr>
                                                <td class="align-middle text-center">{{ $i }}</td>
                                                <td class="align-middle text-center">{{ $item->nama_promo }}</td>
                                                <td class="align-middle text-center">
                                                    @switch($item->branchId)
                                                        @case('020')
                                                            Medan Multatuli
                                                        @break

                                                        @case('062')
                                                            Bali
                                                        @break

                                                        @default
                                                            Medan Multatuli
                                                    @endswitch
                                                </td>
                                                <td class="align-middle text-center">{{ $item->from }}</td>
                                                <td class="align-middle">{{ $item->to }}</td>
                                                <td class="align-middle">{{ $item->description }}</td>
                                                <td class="align-middle text-center">
                                                    @if ($item->active)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">{{ $item->inserttime }}</td>
                                                <td class="align-middle text-center">{{ $item->insertby }}</td>
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
