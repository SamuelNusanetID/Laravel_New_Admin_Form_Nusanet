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
                                <h3 class="card-title">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Informasi Data Pelanggan
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="dataPelangganDataTable">
                                    <thead class="bg-success">
                                        <tr>
                                            <th class="align-middle text-center">No.</th>
                                            <th class="align-middle text-center">ID Pelanggan</th>
                                            <th class="align-middle text-center">Nama Pelanggan</th>
                                            <th class="align-middle text-center">Tipe Pelanggan</th>
                                            <th class="align-middle text-center">PIC Sales</th>
                                            <th class="align-middle text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dataPelanggan as $pelanggan)
                                            <tr>
                                                <td class="align-middle text-center">{{ $i }}</td>
                                                <td class="align-middle text-center">{{ $pelanggan->customer_id }}</td>
                                                <td class="align-middle">{{ $pelanggan->name }}</td>
                                                <td class="align-middle text-center">{{ $pelanggan->class }}</td>
                                                <td class="align-middle">
                                                    @if ($pelanggan->sales_id != null)
                                                        <ol>
                                                            <li>
                                                                <span class="fw-bold">ID Sales :</span>
                                                                {{ $pelanggan->sales_id }}
                                                            </li>
                                                            <li>
                                                                <span class="fw-bold">Nama Sales :</span>
                                                                {{ $pelanggan->sales_name }}
                                                            </li>
                                                        </ol>
                                                    @else
                                                        <p class="text-center p-0 m-0">-</p>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#pelanggan{{ $pelanggan->id }}Modal">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        @include('Admin.Pages.data-pelanggan.modals.detailpelanggan')

                                                        <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/edit') }}"
                                                            class="btn btn-warning">
                                                            <i class="fas fa-edit text-white"></i>
                                                        </a>

                                                        <form class="btn btn-danger"
                                                            action="{{ URL::to('data-pelanggan/' . $pelanggan->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn p-0 m-0">
                                                                <i class="fas fa-trash-alt text-white"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
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
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('addonjs')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#dataPelangganDataTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });
        });
    </script>
@endsection
