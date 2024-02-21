
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
            <img src="{{ asset('assets/gambar/vitamin-b-12.png') }}" width="500" alt="" srcset="">
        </div>
    </div>
    <div class="container-fluid" style="height: 100%; background-color: white">
        <div class="row justify-content-center align-items-center mx-1" style="height: 100%">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Register</h2>
                <form action="{{ route('register') }}" method="POST" autocomplete="off">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                            aria-describedby="emailHelp" value="{{ old('nama_pelanggan') }}">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            aria-describedby="emailHelp" value="{{ old('username') }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            aria-describedby="emailHelp" value="{{ old('alamat') }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <div class="my-2">
                        <button type="submit" class="btn btn-primary btn-block w-100 py-2">Register</button>
                    </div>
                    <div class="mt-5 text-center">
                        <span>Sudah punya akun? <a href="{{ route('login') }}">Login</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection