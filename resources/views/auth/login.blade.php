@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
            <img src="{{ asset('assets/gambar/vitamin-b1.png') }}" width="500" alt="" srcset="">
        </div>
    </div>
    <div class="container-fluid" style="height: 100%; background-color: white">
        <div class="row justify-content-center align-items-center mx-1" style="height: 100%">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Login</h2>
                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="my-2">
                        <button type="submit" class="btn btn-primary btn-block w-100 py-2">Login</button>
                    </div>
                    <div class="mt-5 text-center">
                        <span>Belum punya akun? <a href="{{ route('register') }}">Register</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
