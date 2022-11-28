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
                                    Informasi Profile Saya
                                </h6>
                            </div>
                            <div class="card-body">
                                <form class="d-flex align-items-center justify-content-center flex-column"
                                    action="{{ URL::to('profil-saya') }}" method="POST" enctype="multipart/form-data"
                                    style="width: 100%;">
                                    @csrf
                                    <div class="mb-5 text-center" style="width: 40%;">
                                        <img class="img-circle elevation-2 mb-4"
                                            src="{{ auth()->user()->profile_pic != null ? URL::to(auth()->user()->profile_pic) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                                            alt="profile-photo" width="80" height="80">
                                        <div class="input-group">
                                            <input type="file"
                                                class="form-control @error('profile_pic') is-invalid @enderror"
                                                id="profile_pic" name="profile_pic" aria-describedby="profile_pic_label"
                                                aria-label="profile_pic_upload">
                                            <button class="btn btn-success" type="submit" id="profile_pic_label">Update
                                                Profile</button>
                                            @error('profile_pic')
                                                <div class="invalid-feedback text-start">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                                <div class="container">
                                    <div class="mb-3 row">
                                        <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="email"
                                                name="email" value="{{ auth()->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="employee_id" class="col-sm-2 col-form-label">ID Karyawan</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="employee_id"
                                                name="employee_id" value="{{ auth()->user()->employee_id }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="under_employee_id" class="col-sm-2 col-form-label">ID
                                            Manager</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext"
                                                id="under_employee_id" name="under_employee_id"
                                                value="{{ auth()->user()->under_employee_id }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="isApprovedByAdmin" class="col-sm-2 col-form-label">Status
                                            Verifikasi</label>
                                        <div class="col-sm-10" id="isApprovedByAdmin">
                                            @if (auth()->user()->isApprovedByAdmin)
                                                <span class="badge badge-success">Sudah Diverifikasi</span>
                                            @else
                                                <span class="badge badge-danger">Belum Diverifikasi</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="utype" class="col-sm-2 col-form-label">Jabatan</label>
                                        <div class="col-sm-10">
                                            @switch(auth()->user()->utype)
                                                @case('AuthMaster')
                                                    <input type="text" readonly class="form-control-plaintext" id="utype"
                                                        name="utype" value="Administrator">
                                                @break

                                                @case('AuthCRO')
                                                    <input type="text" readonly class="form-control-plaintext" id="utype"
                                                        name="utype" value="Customer Relation Officer">
                                                @break

                                                @case('AuthSalesManager')
                                                    <input type="text" readonly class="form-control-plaintext" id="utype"
                                                        name="utype" value="Sales Manager">
                                                @break

                                                @case('AuthSales')
                                                    <input type="text" readonly class="form-control-plaintext" id="utype"
                                                        name="utype" value="Account Manager">
                                                @break

                                                @default
                                                    <input type="text" readonly class="form-control-plaintext" id="utype"
                                                        name="utype" value="Administrator">
                                            @endswitch

                                        </div>
                                    </div>
                                </div>
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
