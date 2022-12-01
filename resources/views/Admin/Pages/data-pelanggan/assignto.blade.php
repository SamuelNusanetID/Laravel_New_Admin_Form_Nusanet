@extends('Admin.Layouts.main')

@section('addoncss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <!-- Leaflet Locate Plugin -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.1/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
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
            <div class="container-fluid pb-3">
                <div class="card bg-light">
                    <div class="card-header bg-success text-white">
                        <h6 class="card-title">
                            <i class="fas fa-edit me-1"></i>
                            Ubah Data Pelanggan
                        </h6>
                    </div>
                    <style>
                        .form-control.error {
                            border-color: #dc3545;
                            padding-right: calc(1.5em + .75rem);
                            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
                            background-repeat: no-repeat;
                            background-position: right calc(.375em + .1875rem) center;
                            background-size: calc(.75em + .375rem) calc(.75em + .375rem);
                        }

                        .error {
                            font-size: .875em;
                            color: #dc3545;
                        }
                    </style>
                    <div class="card-body">
                        <form action="{{ URL::to('data-pelanggan/' . $dataPelanggan->id . '/assign-pic') }}" method="POST"
                            enctype="multipart/form-data" id="updateDataPelanggan">
                            @csrf
                            <div class="mb-3">
                                <label for="assigned_sales_manager">Assign To</label>
                                <select class="form-select" name="assigned_sales_manager" id="assigned_sales_manager">
                                    <option disabled selected>Pilih Sales Manager...</option>
                                    @foreach ($dataSalesManager as $SM)
                                        @if (old('title', $dataPelanggan->assigned_sales_manager) == $SM->employee_id)
                                            <option value="{{ $SM->employee_id }}" selected>{{ $SM->name }}</option>
                                        @else
                                            <option value="{{ $SM->employee_id }}">{{ $SM->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="reset" class="btn btn-secondary">Reset Data</button>
                            <button type="submit" class="btn btn-success" id="submitDataUpdated">Submit
                                Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
