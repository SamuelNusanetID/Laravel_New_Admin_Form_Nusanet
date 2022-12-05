@extends('auth.Layouts.main')

@section('auth-wrapper')
    <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
        <div class="card-body">
            <a href="{{ URL::to('login') }}" class="navbar-brand d-flex align-items-center mb-3">
                <!--Logo start-->
                <img src="{{ URL::to('bin/img/0DaWevkh_400x400-removebg-preview.png') }}" alt="" width="30">
                <!--logo End-->
                <h4 class="logo-title ms-3 fw-bold">N U S A N E T</h4>
            </a>
            <h2 class="mb-2 text-center">Dashboard Admin</h2>
            <p class="text-center mb-2">D A F T A R</p>

            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </symbol>
                <symbol id="info-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </symbol>
                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </symbol>
            </svg>
            @if (session()->has('successMessage'))
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
                    <svg width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" role="img"
                        viewBox="0 0 16 16" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div style="text-align: justify;">
                        {{ session('successMessage') }}
                    </div>
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @error('successMessage')
                <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
                    <svg width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" role="img"
                        viewBox="0 0 16 16" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div style="text-align: justify;">
                        {{ $message }}
                    </div>
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @enderror
            @if (session()->has('errorMessage'))
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                    <svg width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" role="img"
                        viewBox="0 0 16 16" aria-label="Success:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div style="text-align: justify;">
                        {{ session('errorMessage') }}
                    </div>
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @error('errorMessage')
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                    <svg width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" role="img"
                        viewBox="0 0 16 16" aria-label="Success:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div style="text-align: justify;">
                        {{ $message }}
                    </div>
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @enderror

            <form action="{{ URL::to('register') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Masukkan email anda..." value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan password anda..."
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Ulangi Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Masukkan ulang password anda..." value="{{ old('password_confirmation') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="employee_id" class="form-label">ID Karyawan</label>
                            <input type="text" class="form-control @error('employee_id') is-invalid @enderror"
                                id="employee_id" name="employee_id" placeholder="Masukkan ID Karyawan..."
                                value="{{ old('email') }}">
                            @error('employee_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="employee_name" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control @error('employee_name') is-invalid @enderror"
                                id="employee_name" name="employee_name" placeholder="Masukkan Nama Karyawan..."
                                value="{{ old('employee_name') }}">
                            @error('employee_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    @php
                        $utype = [
                            [
                                'role' => 'AuthMaster',
                                'name' => 'Administrator',
                            ],
                            [
                                'role' => 'AuthCRO',
                                'name' => 'Customer Relationship Officer',
                            ],
                            [
                                'role' => 'AuthSalesManager',
                                'name' => 'Sales Manager',
                            ],
                            [
                                'role' => 'AuthSales',
                                'name' => 'Account Manager',
                            ],
                        ];
                    @endphp
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="account_type" class="form-label">Jenis Akun</label>
                            <select class="form-select" name="account_type" id="account_type">
                                <option disabled selected>Pilih Jenis Akun...</option>
                                @foreach ($utype as $item)
                                    @if (old('account_type') == $item['role'])
                                        <option value="{{ $item['role'] }}" selected>{{ $item['name'] }}</option>
                                    @else
                                        <option value="{{ $item['role'] }}">{{ $item['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('account_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="customCheck1">
                            <label class="form-check-label" for="customCheck1">Saya setuju dengan syarat dan ketentuan
                                yang
                                berlaku di PT. Media Antar Nusa</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">D A F T A R</button>
                </div>
                <p class="mt-3 text-center">
                    Sudah memiliki akun? <a href="{{ URL::to('login') }}" class="text-underline">Masuk</a>
                </p>
            </form>
        </div>
    </div>
@endsection
