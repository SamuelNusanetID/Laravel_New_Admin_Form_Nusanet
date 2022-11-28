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
                                    <i class="fas fa-info-circle me-1"></i>
                                    Informasi Ubah Password
                                </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ URL::to('ubah-password') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Password Lama</label>
                                        <input type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            id="old_password" name="old_password" placeholder="Masukkan Password Lama...">
                                        @error('old_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Masukkan Password Baru...">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-5">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password
                                            Baru</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Masukkan Ulang Password Baru...">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="text-end">
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="fas fa-ban me-1"></i>
                                            Batalkan Perubahan
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-1"></i>
                                            Simpan Perubahan
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
