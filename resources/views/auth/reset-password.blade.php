@extends('auth.Layouts.main')

@section('auth-wrapper')
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
    @if (session()->has('status'))
        <div class="alert alert-info alert-dismissible d-flex align-items-center fade show" role="alert">
            <svg width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" role="img"
                viewBox="0 0 16 16" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div style="text-align: justify;">
                {{ session('status') }}
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
    <form action="{{ URL::to('reset-password') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder="Masukkan email anda...">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" placeholder="Masukkan password anda...">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Ulangi Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation"
                name="password_confirmation" placeholder="Masukkan ulang password anda...">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="d-flex flex-column mb-3">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-arrow-right-to-bracket me-1"></i>
                Masuk
            </button>
        </div>
    </form>
@endsection
