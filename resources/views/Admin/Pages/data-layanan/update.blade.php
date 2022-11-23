@extends('Admin.Layouts.main')

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
                                    <i class="fas fa-edit me-1"></i>
                                    Ubah {{ $titlePage }}
                                </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ URL::to('data-layanan/' . $dataLayanan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="package_name" class="form-label">
                                            Nama Paket
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('package_name') is-invalid @enderror"
                                            id="package_name" name="package_name" placeholder="Masukkan nama paket..."
                                            value="{{ old('package_name', $dataLayanan->package_name) }}">
                                        @error('package_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @php
                                            $tipePaket = ['Fiber Optic', 'Wireless'];
                                        @endphp
                                        <label for="package_type" class="form-label">
                                            Tipe Paket
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <select class="form-select @error('package_type') is-invalid @enderror"
                                            name="package_type" id="package_type">
                                            <option disabled selected>Pilih tipe paket...</option>
                                            @foreach ($tipePaket as $item)
                                                @if (old('package_type', $dataLayanan->package_type) == $item)
                                                    <option value="{{ $item }}" selected>
                                                        {{ $item }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('package_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="package_categories" class="form-label">
                                            Kategori Paket
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('package_categories') is-invalid @enderror"
                                            id="package_categories" name="package_categories"
                                            placeholder="Masukkan nama paket..."
                                            value="{{ old('package_categories', $dataLayanan->package_categories) }}">
                                        @error('package_categories')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="package_speed" class="form-label">
                                            Kecepatan Paket
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="number"
                                                class="form-control @error('package_speed') is-invalid @enderror"
                                                placeholder="Masukkan kecepatan paket..."
                                                aria-label="Masukkan kecepatan paket..."
                                                aria-describedby="package_speed_label" id="package_speed"
                                                name="package_speed"
                                                value="{{ old('package_speed', $dataLayanan->package_speed) }}">
                                            <span class="input-group-text bg-success text-white"
                                                id="package_speed_label">Mbps</span>
                                            @error('package_speed')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="package_price" class="form-label">
                                            Harga Paket
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-success text-white"
                                                id="package_price_label">Rp.</span>
                                            <input type="number"
                                                class="form-control @error('package_price') is-invalid @enderror"
                                                placeholder="Masukkan harga paket..." aria-label="Masukkan harga paket..."
                                                aria-describedby="package_price_label" id="package_price"
                                                name="package_price"
                                                value="{{ old('package_price', $dataLayanan->package_price) }}">
                                            @error('package_price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="retail_package_price" class="form-label">
                                            Harga Paket Retail
                                            <span class="fw-normal">(Opsional)</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-success text-white"
                                                id="retail_package_price_label">Rp.</span>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan harga paket retail..."
                                                aria-label="Masukkan harga paket retail..."
                                                aria-describedby="retail_package_price_label" name="retail_package_price"
                                                id="retail_package_price"
                                                value="{{ old('retail_package_price', $dataLayanan->retail_package_price) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="government_package_price" class="form-label">
                                            Harga Paket Pemerintah
                                            <span class="fw-normal">(Opsional)</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-success text-white"
                                                id="government_package_price_label">Rp.</span>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan harga paket pemerintah..."
                                                aria-label="Masukkan harga paket pemerintah..."
                                                aria-describedby="government_package_price_label"
                                                name="government_package_price" id="government_package_price"
                                                value="{{ old('government_package_price', $dataLayanan->government_package_price) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="noted_service" class="form-label">Catatan Paket</label>
                                        <input type="text" class="form-control" id="noted_service"
                                            name="noted_service" placeholder="Masukkan catatan paket..."
                                            value="{{ old('noted_service', $dataLayanan->noted_service) }}">
                                    </div>
                                    <div class="text-end" style="width: 100%;">
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="fas fa-ban me-1"></i>
                                            Cancel Data
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-edit me-1"></i>
                                            Ubah Data
                                        </button>
                                    </div>
                                </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var isErrorMessage = {!! json_encode(session()->has('errorMessage')) !!}
            if (isErrorMessage) {
                Swal.fire(
                    'Gagal!',
                    {!! json_encode(session('errorMessage')) !!},
                    'error'
                )
            }
        });
    </script>
@endsection
