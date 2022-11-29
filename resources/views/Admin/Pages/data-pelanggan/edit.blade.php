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
                        <form action="{{ URL::to('data-pelanggan/' . $dataPelanggan->id) }}" method="POST"
                            enctype="multipart/form-data" id="updateDataPelanggan">
                            @csrf
                            @method('PUT')
                            @can('AuthSales')
                                <div class="card mb-3">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="card-title">Data Personal / Data Penanggungjawab</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div
                                                class=" @if ($dataPelanggan->class == 'Bussiness') col-0 col-md-6 @else col-0 col-md-12 @endif">
                                                <div class="mb-3">
                                                    <label for="pic_name" class="form-label">Nama
                                                        Lengkap <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('pic_name') is-invalid @enderror"
                                                        id="pic_name" name="pic_name"
                                                        placeholder="Masukkan Nama Lengkap Anda..."
                                                        value="{{ old('pic_name', $dataPelanggan->name) }}">
                                                    @error('pic_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pic_email_address" class="form-label">Alamat Email
                                                        <span class="text-danger">*</span></label>
                                                    <input type="email"
                                                        class="form-control @error('pic_email_address') is-invalid @enderror"
                                                        id="pic_email_address" name="pic_email_address"
                                                        placeholder="Masukkan Alamat E-Mail Anda..."
                                                        value="{{ old('pic_email_address', $dataPelanggan->email) }}">
                                                    @error('pic_email_address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pic_phone_number" class="form-label">
                                                        Nomor HP/WA yang aktif
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text fw-bold bg-success text-white">+62</span>
                                                        <input type="text"
                                                            class="form-control @error('pic_phone_number') is-invalid @enderror"
                                                            id="pic_phone_number" name="pic_phone_number"
                                                            placeholder="Masukkan Nomor Handphone/Whatsapp Anda..."
                                                            value="{{ old('pic_phone_number', $dataPelanggan->phone_number) }}"
                                                            maxlength="11">
                                                        @error('pic_phone_number')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @php
                                                    $countAddr = old('pic_address') ? count(old('pic_address')) : count(json_decode($dataPelanggan->address));
                                                @endphp
                                                @if ($countAddr == 1)
                                                    <style>
                                                        #map {
                                                            height: 300px;
                                                        }
                                                    </style>
                                                    <label for="address_personal" class="form-label">Pilih Lokasi
                                                        Alamat<span class="text-danger">*</span></label>
                                                    <div class="mb-3" id="map">
                                                    </div>
                                                    <div class="form-text mb-3">
                                                        Silahkan Cari, Geser dan Pilih Lokasi Anda.
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pic_address" class="form-label">Alamat
                                                            Lengkap <span class="text-danger">*</span></label>
                                                        <textarea class="form-control @error('pic_address.0') is-invalid @enderror" id="pic_address" name="pic_address[]"
                                                            aria-describedby="pic_address_help" rows="4" placeholder="Masukkan Alamat Lengkap Anda...">{{ old('pic_address') ? old('pic_address')[0] : json_decode($dataPelanggan->address)[0] }}</textarea>
                                                        <div id="pic_address_help" class="form-text mb-1">
                                                            Alamat ini digunakan sebagai alamat pemasangan internet.
                                                        </div>
                                                        @error('pic_address.0')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="geolocation_bussiness[]"
                                                        id="geolocation_bussiness"
                                                        value="{{ old('geolocation_bussiness') ? old('geolocation_bussiness')[0] : json_decode($dataPelanggan->geolocation)[0] }}">
                                                @else
                                                    @php
                                                        $cAddridx = 1;
                                                    @endphp
                                                    @foreach (old('pic_address', json_decode($dataPelanggan->address)) as $key => $value)
                                                        @if ($cAddridx == $countAddr)
                                                            <style>
                                                                #map {
                                                                    height: 300px;
                                                                }
                                                            </style>
                                                            <label for="address_personal" class="form-label">Pilih Lokasi
                                                                Alamat<span class="text-danger">*</span></label>
                                                            <div class="mb-3" id="map">
                                                            </div>
                                                            <div class="form-text mb-3">
                                                                Silahkan Cari, Geser dan Pilih Lokasi Anda.
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="pic_address_" class="form-label">Alamat
                                                                    Lengkap <span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error('pic_address.' . $cAddridx) is-invalid @enderror" id="pic_address"
                                                                    name="pic_address[]" aria-describedby="pic_address_help" rows="4"
                                                                    placeholder="Masukkan Alamat Lengkap Anda...">{{ $value }}</textarea>
                                                                <div id="pic_address_help" class="form-text mb-1">
                                                                    Alamat ini digunakan sebagai alamat pemasangan internet.
                                                                </div>
                                                                @error('pic_address.' . $cAddridx)
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <input type="hidden" name="geolocation_bussiness[]"
                                                                id="geolocation_bussiness"
                                                                value="{{ old('geolocation_bussiness.' . $cAddridx, json_decode($dataPelanggan->geolocation)[$cAddridx - 1]) }}">
                                                        @else
                                                            <div class="mb-3">
                                                                <label for="pic_address_{{ $key }}"
                                                                    class="form-label">Alamat
                                                                    Lengkap Lama ke - {{ $cAddridx }} <span
                                                                        class="text-danger">*</span></label>
                                                                <textarea class="form-control @error('pic_address.' . $key) is-invalid @enderror"
                                                                    id="pic_address_{{ $key }}" name="pic_address[]" rows="4"
                                                                    placeholder="Masukkan Alamat Lengkap Anda..." readonly>{{ old('pic_address.' . $key, $value) }}</textarea>
                                                                @error('pic_address.{{ $key }}')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="geolocation_bussiness_{{ $key }}"
                                                                    class="form-label">Geolokasi Lama ke -
                                                                    {{ $cAddridx }}
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="geolocation_bussiness[]"
                                                                    id="geolocation_bussiness_{{ $key }}"
                                                                    value="{{ old('geolocation_bussiness.' . $key, json_decode($dataPelanggan->geolocation)[$cAddridx - 1]) }}"
                                                                    readonly>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $cAddridx++;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                                <div class="mb-3">
                                                    <label for="inputGroupIdentityNumberPersonal" class="form-label">
                                                        Nomor Identitas
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    @php
                                                        $tipeIdentitasArr = ['KTP', 'KITAS', 'PASPOR'];
                                                    @endphp
                                                    <div class="input-group" id="inputGroupIdentityNumberPersonal"
                                                        style="width: 100%;">
                                                        <select class="form-select bg-success text-white"
                                                            name="option_pic_identity_number" id="option_pic_identity_number"
                                                            style="width: 20%;">
                                                            <option disabled selected>Pilih...</option>
                                                            @foreach ($tipeIdentitasArr as $item)
                                                                @if (old('option_pic_identity_number', $dataPelanggan->identity_type) == $item)
                                                                    <option value="{{ $item }}" selected>
                                                                        {{ $item }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $item }}">
                                                                        {{ $item }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="text"
                                                            class="form-control @error('pic_identity_number') is-invalid @enderror col-sm-10"
                                                            id="pic_identity_number" name="pic_identity_number"
                                                            placeholder="Masukkan Nomor Identitas Anda..."
                                                            value="{{ old('pic_identity_number', $dataPelanggan->identity_number) }}"
                                                            style="width: 80%;">
                                                        @error('pic_identity_number')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="npwp_number" class="form-label">
                                                        Nomor NPWP
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('npwp_number') is-invalid @enderror"
                                                        id="npwp_number" name="npwp_number"
                                                        placeholder="Masukkan Nomor NPWP..."
                                                        value="{{ old('npwp_number', $dataPelanggan->npwp_number) }}"
                                                        maxlength="11">
                                                    @error('npwp_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="@if ($dataPelanggan->class == 'Bussiness') col-0 col-md-6 @else d-none @endif">
                                                <div class="mb-3">
                                                    <label for="company_name" class="form-label">Nama Perusahaan
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('company_name') is-invalid @enderror"
                                                        id="company_name" name="company_name"
                                                        placeholder="Masukkan Nama Perusahaan Anda..."
                                                        value="{{ old('company_name', $dataPelanggan->company_name) }}">
                                                    @error('company_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="company_address" class="form-label">Alamat Perusahaan
                                                        <span class="text-danger">*</span></label>
                                                    <textarea class="form-control @error('company_address') is-invalid @enderror" id="company_address"
                                                        name="company_address" placeholder="Masukkan Alamat Perusahaan Anda..." rows="4">{{ old('company_address', $dataPelanggan->company_address) }}</textarea>
                                                    @error('company_address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="company_npwp_sppkp" class="form-label">No. NPWP/SPPKP
                                                        Perusahaan
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('company_npwp_sppkp') is-invalid @enderror"
                                                        name="company_npwp_sppkp" placeholder="__.___.___._-___.___"
                                                        data-slots="_" size="13"
                                                        value="{{ old('company_npwp_sppkp', $dataPelanggan->company_npwp) }}"
                                                        id="company_npwp_sppkp">
                                                    @error('company_npwp_sppkp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="company_phone_number" class="form-label">No. Telepon
                                                        Perusahaan
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('company_phone_number') is-invalid @enderror"
                                                        id="company_phone_number" name="company_phone_number"
                                                        placeholder="Masukkan Nomor Telepon Perusahaan Anda..."
                                                        value="{{ old('company_phone_number', $dataPelanggan->company_phone_number) }}">
                                                    @error('company_phone_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header bg-success">
                                        <h6 class="card-title">Data Pembayaran</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="billing_name"
                                                class="form-label @error('billing_name') is-invalid @enderror">Nama
                                                Pembayaran</label>
                                            <input type="text" class="form-control" id="billing_name" name="billing_name"
                                                value="{{ $dataPelanggan->billing->billing_name }}">
                                            @error('billing_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_contact"
                                                class="form-label @error('billing_contact') is-invalid @enderror">Kontak
                                                Pembayaran</label>
                                            <input type="text" class="form-control" id="billing_contact"
                                                name="billing_contact"
                                                value="{{ $dataPelanggan->billing->billing_contact }}">
                                            @error('billing_contact')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        @php
                                            $billingidx = 0;
                                            $billingEmailCount = 1;
                                        @endphp
                                        @foreach (old('billing_email', json_decode($dataPelanggan->billing->billing_email)) as $item)
                                            @if ($billingEmailCount > 1)
                                                <div class="mb-3">
                                                    <label for="billing_email_{{ $billingidx }}" class="form-label">Email
                                                        Pembayaran Ke - {{ $billingEmailCount }}</label>
                                                    <input type="email"
                                                        class="form-control @error('billing_email.' . $billingidx) is-invalid @enderror"
                                                        id="billing_email_{{ $billingidx }}" name="billing_email[]"
                                                        value="{{ $item }}">
                                                    @error('billing_email.' . $billingidx)
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @else
                                                <div class="mb-3">
                                                    <label for="billing_email_{{ $billingidx }}" class="form-label">Email
                                                        Pembayaran</label>
                                                    <input type="email"
                                                        class="form-control @error('billing_email.' . $billingidx) is-invalid @enderror"
                                                        id="billing_email.{{ $billingidx }}" name="billing_email[]"
                                                        value="{{ $item }}">
                                                    @error('billing_email.' . $billingidx)
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @endif
                                            @php
                                                $billingEmailCount++;
                                                $billingidx++;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header bg-success">
                                        <h6 class="card-title">Data Teknikal</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="technical_name"
                                                class="form-label @error('technical_name') is-invalid @enderror">Nama
                                                Pembayaran</label>
                                            <input type="text" class="form-control" id="technical_name"
                                                name="technical_name"
                                                value="{{ $dataPelanggan->technical->technical_name }}">
                                            @error('technical_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="technical_contact"
                                                class="form-label @error('technical_contact') is-invalid @enderror">Kontak
                                                Pembayaran</label>
                                            <input type="text" class="form-control" id="technical_contact"
                                                name="technical_contact"
                                                value="{{ $dataPelanggan->technical->technical_contact }}">
                                            @error('technical_contact')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="technical_email" class="form-label">Email
                                                Pembayaran</label>
                                            <input type="email"
                                                class="form-control @error('technical_email') is-invalid @enderror"
                                                id="technical_email" name="technical_email"
                                                value="{{ $dataPelanggan->technical->technical_email }}">
                                            @error('technical_email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="card-title">Data Layanan</h6>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $packageCount = count(json_decode($dataPelanggan->service->service_package));
                                            $packageIDX = 1;
                                        @endphp
                                        @foreach (json_decode($dataPelanggan->service->service_package) as $key => $value)
                                            @if ($key == $packageCount - 1)
                                                <div class="container-fluid mb-4 p-3" style="border: 1px solid grey;">
                                                    <p class="mb-4 fw-bold">*) Paket Layanan</p>
                                                    <div class="mb-3 row">
                                                        <label for="package_name" class="col-sm-6 col-form-label">Nama
                                                            Paket</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext"
                                                                id="package_name"
                                                                name="data[{{ $packageIDX - 1 }}][service_name]"
                                                                value="{{ old('package_name', json_decode($dataPelanggan->service->service_package)[$key]->service_name) }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="package_price" class="col-sm-6 col-form-label">Harga
                                                            Paket</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-text bg-success"
                                                                    id="basic-addon1">Rp.</span>
                                                                <input type="text" class="form-control" id="package_price"
                                                                    name="data[{{ $packageIDX - 1 }}][service_price]"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="package_price_cache"
                                                        value="{{ json_decode($dataPelanggan->service->service_package)[$key]->service_price }}">
                                                    <div class="mb-3 row">
                                                        <label for="package_top" class="col-sm-6 col-form-label">Jangka
                                                            Waktu
                                                            Pembayaran
                                                            Paket</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="package_top"
                                                                    name="data[{{ $packageIDX - 1 }}][termofpaymentDeals]"
                                                                    value="{{ old('package_top', json_decode($dataPelanggan->service->service_package)[$key]->termofpaymentDeals) }}">
                                                                <span class="input-group-text bg-success"
                                                                    id="basic-addon2">Bulan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="package_promo" class="col-sm-6 col-form-label">Promo
                                                            Paket</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Masukkan kode promo..." id="package_promo"
                                                                    name="data[{{ $packageIDX - 1 }}][package_promo]"
                                                                    value="{{ old('data[' . $packageIDX - 1 . '][package_promo]', json_decode($dataPelanggan->service->service_package)[$key]->package_promo) }}">
                                                                <button class="btn btn-outline-success" type="button"
                                                                    id="btnSubmitPromo">Ambil Promo</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="container-fluid mb-4" style="border: 1px solid grey;">
                                                    <p class="mb-4 fw-bold">*) Paket Layanan Ke - {{ $packageIDX }}</p>
                                                    <div class="mb-3 row">
                                                        <label for="package_name" class="col-sm-6 col-form-label">Nama
                                                            Paket</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext"
                                                                id="package_name"
                                                                name="data[{{ $packageIDX - 1 }}][service_name]"
                                                                value="{{ old('package_name', json_decode($dataPelanggan->service->service_package)[$key]->service_name) }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="package_price" class="col-sm-6 col-form-label">Harga
                                                            Paket</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext"
                                                                id="package_price"
                                                                name="data[{{ $packageIDX - 1 }}][service_price]"
                                                                value="{{ old('package_price', json_decode($dataPelanggan->service->service_package)[$key]->service_price) }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="package_top" class="col-sm-6 col-form-label">Jangka
                                                            Waktu
                                                            Pembayaran
                                                            Paket</label>
                                                        <input type="text" readonly class="form-control-plaintext"
                                                            id="package_top"
                                                            name="data[{{ $packageIDX - 1 }}][termofpaymentDeals]"
                                                            value="{{ old('package_top', json_decode($dataPelanggan->service->service_package)[$key]->termofpaymentDeals) }}">
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="package_promo" class="col-sm-6 col-form-label">Promo
                                                            Paket</label>
                                                        <div class="col-sm-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control-plaintext"
                                                                    placeholder="Masukkan kode promo..." id="package_promo"
                                                                    name="data[{{ $packageIDX - 1 }}][package_promo]"
                                                                    value="{{ old('data[' . $packageIDX - 1 . '][package_promo]', json_decode($dataPelanggan->service->service_package)[$key]->package_promo) }}">
                                                                <button class="btn btn-outline-success" type="button"
                                                                    id="btnSubmitPromo" disabled>Ambil Promo</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @php
                                                $packageIDX++;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                                @if (!$dataPelanggan->isCustomerIS)
                                    <div class="card mb-3">
                                        <div class="card-header bg-success text-white">
                                            <h6 class="card-title">
                                                Dokumen Pendukung
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            @if ($dataPelanggan->class == 'Personal')
                                                <div class="row">
                                                    <div
                                                        class="@if ($dataPelanggan->npwp_files != null) col-sm-6 @else col-sm-12 @endif">
                                                        <label for="id_photo_url">Foto Identitas</label>
                                                        <img src="{{ $dataPelanggan->service->id_photo_url }}"
                                                            alt="foto-identitas" class="img-fluid mb-3" id="id_photo_url">
                                                        <label for="id_photo_url">Ganti Foto Identitas</label>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="upload_foto_identitas">Upload
                                                                Foto
                                                                Identitas</label>
                                                            <input type="file" class="form-control"
                                                                id="upload_foto_identitas" name="upload_foto_identitas">
                                                        </div>
                                                    </div>
                                                    @if ($dataPelanggan->npwp_files != null)
                                                        <div class="col-sm-6">
                                                            <label for="npwp_files">Foto NPWP</label>
                                                            <img src="{{ $dataPelanggan->npwp_files }}" alt="foto-identitas"
                                                                class="img-fluid mb-3" id="npwp_files">
                                                            <label for="npwp_files">Ganti Foto NPWP</label>
                                                            <div class="input-group mb-3">
                                                                <label class="input-group-text" for="upload_foto_npwp">Upload
                                                                    Foto
                                                                    NPWP</label>
                                                                <input type="file" class="form-control"
                                                                    id="upload_foto_npwp" name="upload_foto_npwp">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @elseif ($dataPelanggan->class == 'Bussiness')
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="id_photo_url">Foto Identitas</label>
                                                        <img src="{{ $dataPelanggan->service->id_photo_url }}"
                                                            alt="foto-identitas" class="img-fluid mb-3" id="id_photo_url">
                                                        <label for="id_photo_url">Ganti Foto Identitas</label>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="upload_foto_identitas">Upload
                                                                Foto
                                                                Identitas</label>
                                                            <input type="file" class="form-control"
                                                                id="upload_foto_identitas" name="upload_foto_identitas">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="id_photo_url">Foto NPWP/SPPKP Perusahaan</label>
                                                        <img src="{{ $dataPelanggan->company_npwp_files }}"
                                                            alt="foto-identitas" class="img-fluid mb-3"
                                                            id="company_npwp_files">
                                                        <label for="id_photo_url">Ganti Foto NPWP/SPPKP Perusahaan</label>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text"
                                                                for="upload_foto_npwp_sppkp">Upload
                                                                Foto
                                                                NPWP/SPPKP</label>
                                                            <input type="file" class="form-control"
                                                                id="upload_foto_npwp_sppkp" name="upload_foto_npwp_sppkp">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="card mb-3">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="card-title">
                                            Data Tambahan
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        @if ($dataPelanggan->reference_id == null)
                                            <div class="mb-3 row">
                                                <label for="reference_id" class="col-sm-6 col-form-label">ID Sales</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="reference_id"
                                                        name="reference_id" value="{{ old('reference_id') }}">
                                                </div>
                                            </div>
                                        @else
                                            <ol class="mb-3 p-0 m-0 px-3">
                                                <li class="mb-2">
                                                    <span class="fw-bold">ID Sales :</span>
                                                    {{ $dataPelanggan->sales_id }}
                                                </li>
                                                <li>
                                                    <span class="fw-bold">Nama Sales
                                                        :</span>
                                                    {{ $dataPelanggan->sales_name }}
                                                </li>
                                            </ol>
                                        @endif
                                        <div class="mb-3">
                                            <label for="survey_id">ID Survey</label>
                                            <input class="form-control @error('survey_id') is-invalid @enderror"
                                                id="survey_id" name="survey_id" value="{{ $dataPelanggan->survey_id }}"
                                                style="text-align: justify;" />
                                            @error('survey_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="extend_note">Catatan</label>
                                            <textarea class="form-control @error('extend_note') is-invalid @enderror" id="extend_note" name="extend_note"
                                                rows="5" style="text-align: justify;">{{ $dataPelanggan->extend_note }}</textarea>
                                            @error('extend_note')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('AuthCRO')
                                <div class="mb-3 row">
                                    <label for="reference_id" class="col-sm-6 col-form-label">ID Sales</label>
                                    <div class="col-sm-6">
                                        <input type="text"
                                            class="form-control @error('reference_id') is-invalid @enderror"
                                            id="reference_id" name="reference_id" value="{{ old('reference_id') }}">
                                        @error('reference_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            @endcan
                            <button type="reset" class="btn btn-secondary">Reset Data</button>
                            <button type="submit" class="btn btn-success" id="submitDataUpdated">Submit
                                Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        date_default_timezone_set('Asia/Jakarta');

        $fetchAllDataPromo = $dataPromo->toArray();
        foreach ($fetchAllDataPromo as $key => $value) {
            if (!(date('Y-m-d H:i:s') > $value['activate_date'] && date('Y-m-d H:i:s') < $value['expired_date'])) {
                unset($fetchAllDataPromo[$key]);
            }
        }
    @endphp
@endsection

@section('addonjs')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/inputFilter.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/cboConfig.js') }}"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <!-- Leaflet Plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.1/dist/L.Control.Locate.min.js" charset="utf-8">
    </script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- GeoLocation ScriptJS -->
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/mapconfig.js') }}"></script>
    <script src="{{ URL::to('lib/jQuerymask/regex-mask-plugin.js') }}"></script>
    <script src="{{ URL::to('bin/js/newCustomer/bussiness/inputmask.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            const value = (harga) => {
                return new Intl.NumberFormat('de-DE', {
                    style: 'currency',
                    currency: 'EUR',
                }).formatToParts(harga).map(
                    p => p.type != 'literal' && p.type != 'currency' ? p.value : ''
                ).join('')
            };

            const hargaRealPaket = $('#package_price_cache').val();
            var hargaUntukHitungan = hargaRealPaket;
            $('#package_price').val(value(hargaRealPaket));

            $('#package_top').on('input', function() {
                if ($(this).val() != "" && $(this).val() != 0) {
                    $('#package_price').val(value($(this).val() * hargaRealPaket));
                    hargaUntukHitungan = $(this).val() * hargaRealPaket;
                }
            });

            const date = new Date;
            $('#btnSubmitPromo').on('click', () => {
                var isError = false;
                var statusPaket = "Bulanan";
                const PromoArr = {!! json_encode($fetchAllDataPromo) !!};
                const kodePromo = $('#package_promo').val();
                const namaPaket = $('#package_name').val();
                const hargaPaket = hargaUntukHitungan;
                const jangkaWaktuPaket = $('#package_top').val();
                if (jangkaWaktuPaket >= 12) {
                    statusPaket = "Tahunan";
                }
                const arrNamaPaket = namaPaket.split(' ');

                if (PromoArr.length > 0) {
                    PromoArr.forEach(element => {
                        if (element.promo_code == kodePromo) {
                            if (isSame(namaPaket, element.package_name) && element.package_top ==
                                statusPaket) {
                                isError = false;

                                var persenDiscount = element.discount_cut != '-' ? element
                                    .discount_cut / 100 : 0;

                                if (element.monthly_cut_status == "Penambahan") {
                                    $('#package_price').val(value(hargaPaket - (hargaPaket *
                                        persenDiscount)));
                                    hargaUntukHitungan = hargaPaket - (hargaPaket *
                                        persenDiscount);
                                    $('#package_top').val((jangkaWaktuPaket + element
                                        .monthly_cut));
                                } else if (element.monthly_cut_status == "Pengurangan") {
                                    if (jangkaWaktuPaket <= element
                                        .monthly_cut) {
                                        isError = true;
                                    } else {
                                        $('#package_price').val(value(hargaPaket - (hargaPaket *
                                            persenDiscount)));
                                        hargaUntukHitungan = hargaPaket - (hargaPaket *
                                            persenDiscount);
                                        $('#package_top').val((jangkaWaktuPaket -
                                            element
                                            .monthly_cut));
                                    }
                                } else {
                                    if (jangkaWaktuPaket <= element
                                        .monthly_cut) {
                                        isError = true;
                                    } else {
                                        $('#package_price').val(value(hargaPaket - (hargaPaket *
                                            persenDiscount)));
                                        hargaUntukHitungan = hargaPaket - (hargaPaket *
                                            persenDiscount);
                                        $('#package_top').val((jangkaWaktuPaket -
                                            element
                                            .monthly_cut));
                                    }
                                }
                            } else {
                                isError = true;
                            }
                        } else {
                            isError = true;
                        }
                    });
                } else {
                    isError = true;
                }

                if (isError) {
                    alert('Maaf, Kode Promo Tidak Ditemukan!, Silahkan coba lagi.');
                }
            })
        });

        function isSame(str1, str2) {
            var str1Arr = str1.split(' ');
            return str1Arr[0] + ' ' + str1Arr[1] == str2;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
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
