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
                                    <i class="fas fa-plus-circle me-1"></i>
                                    Tambah {{ $titlePage }}
                                </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ URL::to('data-promo') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="promo_name" class="form-label">
                                            Nama Promo
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('promo_name') is-invalid @enderror"
                                            id="promo_name" name="promo_name" placeholder="Masukkan nama promo..."
                                            value="{{ old('promo_name') }}">
                                        @error('promo_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @php
                                            $branchList = [
                                                [
                                                    'branch_code' => '020',
                                                    'branch_name' => 'Medan Multatuli',
                                                ],
                                                [
                                                    'branch_code' => '062',
                                                    'branch_name' => 'Bali',
                                                ],
                                            ];
                                        @endphp
                                        <label for="branch_id" class="form-label">
                                            Cabang
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <select class="form-select @error('branch_id') is-invalid @enderror"
                                            name="branch_id" id="branch_id">
                                            <option disabled selected>Pilih Cabang...</option>
                                            @foreach ($branchList as $item)
                                                @if (old('branch_id') == $item['branch_code'])
                                                    <option value="{{ $item['branch_code'] }}" selected>
                                                        {{ $item['branch_name'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item['branch_code'] }}">{{ $item['branch_name'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('branch_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="package_name" class="form-label">
                                            Nama Paket
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <select class="form-select @error('package_name') is-invalid @enderror"
                                            name="package_name" id="package_name">
                                            <option disabled selected>Pilih nama paket...</option>
                                            @foreach ($packageList as $item)
                                                @if (old('package_name') == $item)
                                                    <option value="{{ $item }}" selected>
                                                        {{ $item }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item }}">{{ $item }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('package_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @php
                                            $jangkaWaktu = ['Bulanan', 'Tahunan'];
                                        @endphp
                                        <label for="package_top" class="form-label">
                                            Jangka Waktu Pembayaran
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <select class="form-select @error('package_top') is-invalid @enderror"
                                            name="package_top" id="package_top">
                                            <option disabled selected>Pilih jangka waktu...</option>
                                            @foreach ($jangkaWaktu as $item)
                                                @if (old('package_top') == $item)
                                                    <option value="{{ $item }}" selected>
                                                        {{ $item }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('package_top')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="discount_cut" class="form-label">
                                            Diskon
                                        </label>
                                        <div class="input-group">
                                            <input type="number"
                                                class="form-control @error('discount_cut') is-invalid @enderror"
                                                placeholder="Masukkan diskon..." aria-label="Masukkan diskon..."
                                                aria-describedby="discount_cut_label" id="discount_cut" name="discount_cut"
                                                value="{{ old('discount_cut') }}">
                                            <span class="input-group-text bg-success text-white"
                                                id="discount_cut_label">%</span>
                                            @error('discount_cut')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="monthly_cut" class="form-label">
                                            Jumlah Bulan
                                        </label>
                                        <div class="input-group">
                                            <input type="number"
                                                class="form-control @error('monthly_cut') is-invalid @enderror"
                                                placeholder="Masukkan jumlah bulan..." aria-label="Masukkan jumlah bulan..."
                                                aria-describedby="monthly_cut_label" id="monthly_cut" name="monthly_cut"
                                                value="{{ old('monthly_cut') }}">
                                            <span class="input-group-text bg-success text-white"
                                                id="monthly_cut_label">Bulan</span>
                                            @error('monthly_cut')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        @php
                                            $monthlyStat = ['None', 'Penambahan', 'Pengurangan'];
                                        @endphp
                                        <label for="monthly_cut_status" class="form-label">
                                            Kriteria Promo
                                        </label>
                                        <select class="form-select @error('monthly_cut_status') is-invalid @enderror"
                                            name="monthly_cut_status" id="monthly_cut_status">
                                            <option disabled selected>Pilih kriteria promo...</option>
                                            @foreach ($monthlyStat as $item)
                                                @if (old('monthly_cut_status') == $item)
                                                    <option value="{{ $item }}" selected>
                                                        {{ $item }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('monthly_cut_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="promo_desc" class="form-label">
                                            Deskripsi Promo
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <textarea class="form-control @error('promo_desc') is-invalid @enderror" id="promo_desc" name="promo_desc"
                                            rows="5" placeholder="Masukkan Deskripsi Promo...">{{ old('promo_desc') }}</textarea>
                                        @error('promo_desc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @php
                                            $monthlyStat = ['Aktif', 'Tidak Aktif'];
                                        @endphp
                                        <label for="promo_status" class="form-label">
                                            Status Promo
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <select class="form-select @error('promo_status') is-invalid @enderror"
                                            name="promo_status" id="promo_status">
                                            <option disabled selected>Pilih status promo...</option>
                                            @foreach ($monthlyStat as $item)
                                                @if (old('promo_status') == $item)
                                                    <option value="{{ $item }}" selected>
                                                        {{ $item }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('promo_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="activate_date" class="form-label">
                                            Tanggal Aktif Promo
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="datetime-local"
                                            class="form-control @error('activate_date') is-invalid @enderror"
                                            id="activate_date" name="activate_date"
                                            placeholder="Masukkan tanggal aktif promo..."
                                            value="{{ old('activate_date') }}">
                                        @error('activate_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="expired_date" class="form-label">
                                            Tanggal Berakhir Promo
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="datetime-local"
                                            class="form-control @error('expired_date') is-invalid @enderror"
                                            id="expired_date" name="expired_date"
                                            placeholder="Masukkan tanggal berakhir promo..."
                                            value="{{ old('expired_date') }}">
                                        @error('expired_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="text-end" style="width: 100%;">
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="fas fa-ban me-1"></i>
                                            Cancel Data
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-1"></i>
                                            Simpan Data
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
