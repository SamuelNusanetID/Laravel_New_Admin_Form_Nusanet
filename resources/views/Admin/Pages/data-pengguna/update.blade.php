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
                                <form action="{{ URL::to('data-pengguna/' . $dataPengguna->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            Email
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukkan email..."
                                            value="{{ old('email', $dataPengguna->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="password" class="form-label">
                                            Password
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Masukkan password..."
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">
                                            Ulangi Password
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Masukkan ulang password..."
                                            value="{{ old('password_confirmation') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="employee_id" class="form-label">
                                            ID Karyawan
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('employee_id') is-invalid @enderror" id="employee_id"
                                            name="employee_id" placeholder="Masukkan ID Karyawan..."
                                            value="{{ old('employee_id', $dataPengguna->employee_id) }}">
                                        @error('employee_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            Nama Karyawan
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Masukkan nama karyawan..."
                                            value="{{ old('name', $dataPengguna->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="under_employee_id" class="form-label">
                                            ID Manager
                                        </label>
                                        <input type="text"
                                            class="form-control @error('under_employee_id') is-invalid @enderror"
                                            id="under_employee_id" name="under_employee_id"
                                            placeholder="Masukkan ID Manager..."
                                            value="{{ old('under_employee_id', $dataPengguna->under_employee_id) }}">
                                        @error('under_employee_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @php
                                            $authType = [
                                                [
                                                    'role_name' => 'AuthMaster',
                                                    'role_desc' => 'Administrator',
                                                ],
                                                [
                                                    'role_name' => 'AuthCRO',
                                                    'role_desc' => 'Customer Relation Officer',
                                                ],
                                                [
                                                    'role_name' => 'AuthSalesManager',
                                                    'role_desc' => 'Sales Manager',
                                                ],
                                                [
                                                    'role_name' => 'AuthSales',
                                                    'role_desc' => 'Sales',
                                                ],
                                            ];
                                        @endphp
                                        <label for="utype" class="form-label">
                                            Aturan Pengguna
                                            <span class="text-danger ms-1">*</span>
                                        </label>
                                        <select class="form-select @error('utype') is-invalid @enderror" name="utype"
                                            id="utype">
                                            <option disabled selected>Pilih aturan pengguna...</option>
                                            @foreach ($authType as $item)
                                                @if (old('utype', $dataPengguna->utype) == $item['role_name'])
                                                    <option value="{{ $item['role_name'] }}" selected>
                                                        {{ $item['role_desc'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item['role_name'] }}">{{ $item['role_desc'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('utype')
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
