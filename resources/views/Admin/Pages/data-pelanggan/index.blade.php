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
                                <h3 class="card-title mb-3 mb-sm-0">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Informasi Data Pelanggan
                                </h3>
                                @php
                                    $class = ['Personal', 'Bussiness'];
                                    $idxNav = 0;
                                    $idxCont = 0;
                                @endphp
                                <div class="card-tools">
                                    <ul class="nav nav-pills bg-white rounded" id="pills-tab" role="tablist">
                                        @foreach ($class as $cls)
                                            @if ($idxNav == 0)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-{{ $cls }}-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-{{ $cls }}"
                                                        type="button" role="tab"
                                                        aria-controls="pills-{{ $cls }}"
                                                        aria-selected="true">{{ $cls }}</button>
                                                </li>
                                            @else
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-{{ $cls }}-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-{{ $cls }}"
                                                        type="button" role="tab"
                                                        aria-controls="pills-{{ $cls }}"
                                                        aria-selected="true">{{ $cls }}</button>
                                                </li>
                                            @endif
                                            @php
                                                $idxNav++;
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="pills-tabContent">
                                    @foreach ($class as $cls)
                                        @if ($idxCont == 0)
                                            <div class="tab-pane fade show active" id="pills-{{ $cls }}"
                                                role="tabpanel" aria-labelledby="pills-{{ $cls }}-tab"
                                                tabindex="0">
                                                <table class="table table-bordered table-striped"
                                                    id="dataPelangganDataTable-{{ $cls }}" style="width: 100%;">
                                                    <thead class="bg-success">
                                                        <tr>
                                                            <th class="align-middle text-center">No.</th>
                                                            <th class="align-middle text-center">ID Pelanggan</th>
                                                            <th class="align-middle text-center">Nama Pelanggan</th>
                                                            <th class="align-middle text-center">PIC Sales</th>
                                                            <th class="align-middle text-center">Status</th>
                                                            <th class="align-middle text-center"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($dataPelanggan as $pelanggan)
                                                            @if ($pelanggan->class == $cls)
                                                                <tr>
                                                                    <td class="align-middle text-center">
                                                                        {{ $i }}</td>
                                                                    <td class="align-middle text-center">
                                                                        {{ $pelanggan->customer_id }}</td>
                                                                    <td class="align-middle">{{ $pelanggan->name }}</td>
                                                                    <td class="align-middle">
                                                                        @if ($pelanggan->sales_id != null)
                                                                            <ol>
                                                                                <li>
                                                                                    <span class="fw-bold">ID Sales :</span>
                                                                                    {{ $pelanggan->sales_id }}
                                                                                </li>
                                                                                <li>
                                                                                    <span class="fw-bold">Nama Sales
                                                                                        :</span>
                                                                                    {{ $pelanggan->sales_name }}
                                                                                </li>
                                                                            </ol>
                                                                        @else
                                                                            <p class="text-center p-0 m-0">-</p>
                                                                        @endif
                                                                    </td>

                                                                    @if ($pelanggan->approval->next_staging_area != null)
                                                                        @php
                                                                            $statusArr = json_decode($pelanggan->approval->array_approval)->{$pelanggan->approval->current_staging_area};
                                                                            $nama_role = '';
                                                                            switch ($pelanggan->approval->current_staging_area) {
                                                                                case 'AuthCRO':
                                                                                    $nama_role = 'CRO';
                                                                                    break;
                                                                                case 'AuthSalesManager':
                                                                                    $nama_role = 'Sales Manager';
                                                                                    break;
                                                                                case 'AuthSales':
                                                                                    $nama_role = 'Sales';
                                                                                    break;
                                                                                default:
                                                                                    $nama_role = 'Sales';
                                                                                    break;
                                                                            }
                                                                        @endphp
                                                                        @if ($statusArr->isApproved == null && $statusArr->isRejected == null)
                                                                            <td class="align-middle text-center">
                                                                                <span
                                                                                    class="badge badge-warning text-white">
                                                                                    Menunggu
                                                                                    revisi
                                                                                    {{ $statusArr->PIC_Name != null ? $statusArr->PIC_Name : $nama_role }}
                                                                                </span>
                                                                            </td>
                                                                        @else
                                                                            @if ($statusArr->isApproved == false && $statusArr->isRejected == false)
                                                                                <td class="align-middle text-center">
                                                                                    <span
                                                                                        class="badge badge-success text-white">
                                                                                        Permohonan telah terkirim
                                                                                    </span>
                                                                                </td>
                                                                            @elseif ($statusArr->isApproved == true && $statusArr->isRejected == false)
                                                                                <td class="align-middle text-center">
                                                                                    <span
                                                                                        class="badge badge-success text-white">
                                                                                        Telah diapprove
                                                                                        {{ $statusArr->PIC_Name != null ? $statusArr->PIC_Name : $nama_role }}
                                                                                    </span>
                                                                                </td>
                                                                            @elseif ($statusArr->isApproved == false && $statusArr->isRejected == true)
                                                                                <td class="align-middle text-center">
                                                                                    <span
                                                                                        class="badge badge-danger text-white">
                                                                                        Telah ditolak
                                                                                        {{ $statusArr->PIC_Name != null ? $statusArr->PIC_Name : $nama_role }}
                                                                                    </span>
                                                                                </td>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        <td class="align-middle text-center">
                                                                            <span class="badge badge-success text-white">
                                                                                Data Pelanggan Telah Diterima Oleh Sales
                                                                            </span>
                                                                        </td>
                                                                    @endif

                                                                    <td class="align-middle text-center">
                                                                        <div class="btn-group" role="group"
                                                                            aria-label="Basic example">
                                                                            <button type="button" class="btn btn-primary"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#pelanggan{{ $pelanggan->id }}Modal">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                            @include('Admin.Pages.data-pelanggan.modals.' .
                                                                                    $cls .
                                                                                    '.layouts.index')
                                                                            @can('AuthSales')
                                                                                @if ($pelanggan->approval->next_staging_area != null)
                                                                                    @if ($pelanggan->approval->current_staging_area == 'AuthSales')
                                                                                        <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/edit') }}"
                                                                                            class="btn btn-warning">
                                                                                            <i
                                                                                                class="fas fa-edit text-white"></i>
                                                                                        </a>
                                                                                        <form class="btn btn-danger"
                                                                                            action="{{ URL::to('data-pelanggan/' . $pelanggan->id) }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="submit"
                                                                                                class="btn p-0 m-0">
                                                                                                <i
                                                                                                    class="fas fa-trash-alt text-white"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                @else
                                                                                    <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/edit') }}"
                                                                                        class="btn btn-warning">
                                                                                        <i class="fas fa-edit text-white"></i>
                                                                                    </a>
                                                                                    <form class="btn btn-danger"
                                                                                        action="{{ URL::to('data-pelanggan/' . $pelanggan->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="btn p-0 m-0">
                                                                                            <i
                                                                                                class="fas fa-trash-alt text-white"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                @endif
                                                                            @elsecan('AuthCRO')
                                                                                @if (!$pelanggan->reference_id)
                                                                                    <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/edit') }}"
                                                                                        class="btn btn-warning">
                                                                                        <i class="fas fa-edit text-white"></i>
                                                                                    </a>
                                                                                @endif
                                                                                <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/download') }}"
                                                                                    class="btn btn-info">
                                                                                    <i class="fas fa-download"></i>
                                                                                </a>
                                                                                <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/assign-pic') }}"
                                                                                    class="btn btn-secondary">
                                                                                    <i class="fas fa-mail-bulk"></i>
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        @else
                                            <div class="tab-pane fade" id="pills-{{ $cls }}" role="tabpanel"
                                                aria-labelledby="pills-{{ $cls }}-tab" tabindex="0">
                                                <table class="table table-bordered table-striped"
                                                    id="dataPelangganDataTable-{{ $cls }}" style="width: 100%;">
                                                    <thead class="bg-success">
                                                        <tr>
                                                            <th class="align-middle text-center">No.</th>
                                                            <th class="align-middle text-center">ID Pelanggan</th>
                                                            <th class="align-middle text-center">Nama Pelanggan</th>
                                                            <th class="align-middle text-center">PIC Sales</th>
                                                            <th class="align-middle text-center">Status</th>
                                                            <th class="align-middle text-center"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($dataPelanggan as $pelanggan)
                                                            @if ($pelanggan->class == $cls)
                                                                <tr>
                                                                    <td class="align-middle text-center">
                                                                        {{ $i }}</td>
                                                                    <td class="align-middle text-center">
                                                                        {{ $pelanggan->customer_id }}</td>
                                                                    <td class="align-middle">{{ $pelanggan->name }}</td>
                                                                    <td class="align-middle">
                                                                        @if ($pelanggan->sales_id != null)
                                                                            <ol>
                                                                                <li>
                                                                                    <span class="fw-bold">ID Sales :</span>
                                                                                    {{ $pelanggan->sales_id }}
                                                                                </li>
                                                                                <li>
                                                                                    <span class="fw-bold">Nama Sales
                                                                                        :</span>
                                                                                    {{ $pelanggan->sales_name }}
                                                                                </li>
                                                                            </ol>
                                                                        @else
                                                                            <p class="text-center p-0 m-0">-</p>
                                                                        @endif
                                                                    </td>

                                                                    @if ($pelanggan->approval->next_staging_area != null)
                                                                        @php
                                                                            $statusArr = json_decode($pelanggan->approval->array_approval)->{$pelanggan->approval->current_staging_area};
                                                                            $nama_role = '';
                                                                            switch ($pelanggan->approval->current_staging_area) {
                                                                                case 'AuthCRO':
                                                                                    $nama_role = 'CRO';
                                                                                    break;
                                                                                case 'AuthSalesManager':
                                                                                    $nama_role = 'Sales Manager';
                                                                                    break;
                                                                                case 'AuthSales':
                                                                                    $nama_role = 'Sales';
                                                                                    break;
                                                                                default:
                                                                                    $nama_role = 'Sales';
                                                                                    break;
                                                                            }
                                                                        @endphp
                                                                        @if ($statusArr->isApproved == null && $statusArr->isRejected == null)
                                                                            <td class="align-middle text-center">
                                                                                <span
                                                                                    class="badge badge-warning text-white">
                                                                                    Menunggu
                                                                                    revisi
                                                                                    {{ $statusArr->PIC_Name != null ? $statusArr->PIC_Name : $nama_role }}
                                                                                </span>
                                                                            </td>
                                                                        @else
                                                                            @if ($statusArr->isApproved == false && $statusArr->isRejected == false)
                                                                                <td class="align-middle text-center">
                                                                                    <span
                                                                                        class="badge badge-success text-white">
                                                                                        Permohonan telah terkirim
                                                                                    </span>
                                                                                </td>
                                                                            @elseif ($statusArr->isApproved == true && $statusArr->isRejected == false)
                                                                                <td class="align-middle text-center">
                                                                                    <span
                                                                                        class="badge badge-success text-white">
                                                                                        Telah diapprove
                                                                                        {{ $statusArr->PIC_Name != null ? $statusArr->PIC_Name : $nama_role }}
                                                                                    </span>
                                                                                </td>
                                                                            @elseif ($statusArr->isApproved == false && $statusArr->isRejected == true)
                                                                                <td class="align-middle text-center">
                                                                                    <span
                                                                                        class="badge badge-danger text-white">
                                                                                        Telah ditolak
                                                                                        {{ $statusArr->PIC_Name != null ? $statusArr->PIC_Name : $nama_role }}
                                                                                    </span>
                                                                                </td>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        <td class="align-middle text-center">
                                                                            <span class="badge badge-success text-white">
                                                                                Data Pelanggan Telah Diterima Oleh Sales
                                                                            </span>
                                                                        </td>
                                                                    @endif

                                                                    <td class="align-middle text-center">
                                                                        <div class="btn-group" role="group"
                                                                            aria-label="Basic example">
                                                                            <button type="button" class="btn btn-primary"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#pelanggan{{ $pelanggan->id }}Modal">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                            @include('Admin.Pages.data-pelanggan.modals.' .
                                                                                    $cls .
                                                                                    '.layouts.index')

                                                                            @can('AuthSales')
                                                                                @if ($pelanggan->approval->next_staging_area != null)
                                                                                    @if ($pelanggan->approval->current_staging_area == 'AuthSales')
                                                                                        <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/edit') }}"
                                                                                            class="btn btn-warning">
                                                                                            <i
                                                                                                class="fas fa-edit text-white"></i>
                                                                                        </a>
                                                                                        <form class="btn btn-danger"
                                                                                            action="{{ URL::to('data-pelanggan/' . $pelanggan->id) }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="submit"
                                                                                                class="btn p-0 m-0">
                                                                                                <i
                                                                                                    class="fas fa-trash-alt text-white"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    @endif
                                                                                @else
                                                                                    <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/edit') }}"
                                                                                        class="btn btn-warning">
                                                                                        <i class="fas fa-edit text-white"></i>
                                                                                    </a>
                                                                                    <form class="btn btn-danger"
                                                                                        action="{{ URL::to('data-pelanggan/' . $pelanggan->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="btn p-0 m-0">
                                                                                            <i
                                                                                                class="fas fa-trash-alt text-white"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                @endif
                                                                            @elsecan('AuthCRO')
                                                                                @if (!$pelanggan->reference_id)
                                                                                    <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/edit') }}"
                                                                                        class="btn btn-warning">
                                                                                        <i class="fas fa-edit text-white"></i>
                                                                                    </a>
                                                                                @endif
                                                                                <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/download') }}"
                                                                                    class="btn btn-info">
                                                                                    <i class="fas fa-download "></i>
                                                                                </a>
                                                                                <a href="{{ URL::to('data-pelanggan/' . $pelanggan->id . '/assign-pic') }}"
                                                                                    class="btn btn-secondary">
                                                                                    <i class="fas fa-mail-bulk"></i>
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        @php
                                            $idxCont++;
                                        @endphp
                                    @endforeach
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const typeData = ['Personal', 'Bussiness'];

            typeData.forEach(element => {
                $(`#dataPelangganDataTable-${element}`).DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
                });
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
    <!-- Modal Validation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            const listDataPelanggan = {!! json_encode($dataPelanggan) !!};

            listDataPelanggan.forEach(element => {
                $(`#approvalRequestForm-${element.id}`).validate({
                    errorPlacement: (error, element) => {
                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    rules: {
                        message_body_notification: {
                            required: true
                        },
                    },
                    messages: {
                        message_body_notification: {
                            required: 'Field Deskripsi Pesan Wajib Diisi'
                        },
                    }
                });

                $(`#submittedBtnApproval-${element.id}`).on('click', () => {
                    const statusValidationApproval = $(`#approvalRequestForm-${element.id}`)
                        .valid();

                    if (statusValidationApproval) {
                        $(`#approvalRequestForm-${element.id}`).trigger('submit');
                    }
                });

                $(`#rejectedRequestForm-${element.id}`).validate({
                    errorPlacement: (error, element) => {
                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    rules: {
                        message_body_notification: {
                            required: true
                        },
                    },
                    messages: {
                        message_body_notification: {
                            required: 'Field Deskripsi Pesan Wajib Diisi'
                        },
                    }
                });

                $(`#submittedBtnRejected-${element.id}`).on('click', () => {
                    const statusValidationApproval = $(`#rejectedRequestForm-${element.id}`)
                        .valid();

                    if (statusValidationApproval) {
                        $(`#rejectedRequestForm-${element.id}`).trigger('submit');
                    }
                });
            });
        });
    </script>
@endsection
