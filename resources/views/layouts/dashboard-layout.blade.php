<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/dashboard.css') }}">

    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="mx-5 d-flex flex-row align-items-center gap-3" style="width: 100%">
                <div class="d-flex flex-row gap-2">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/gambar/icon.png') }}" width="60" alt="" srcset="">
                    </div>
                </div>
                <div class="d-flex flex-row gap-2">
                    @if (Auth::user()->role == 'admin')
                        <div class="btn">
                            <a style="text-decoration: none; color: black; font-size: 24px; font-weight: 500;"
                                href="{{ route('dashboard.admin') }}">Dashboard</a>
                        </div>
                        <div class="btn">
                            <a style="text-decoration: none; color: black; font-size: 24px; font-weight: 500;"
                                href="{{ route('obat.admin') }}">Obat</a>
                        </div>
                        <div class="btn">
                            <a style="text-decoration: none; color: black; font-size: 24px; font-weight: 500;"
                                href="{{ route('kategori.admin') }}">Kategori Obat</a>
                        </div>
                        <div class="btn">
                            <a style="text-decoration: none; color: black; font-size: 24px; font-weight: 500;"
                                href="{{ route('proses.transaksi.admin') }}">Proses Transaksi</a>
                        </div>
                        <div class="btn">
                            <a style="text-decoration: none; color: black; font-size: 24px; font-weight: 500;"
                                href="{{ route('transaksi.admin') }}">Transaksi</a>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'petugas')
                        <div class="btn">
                            <a style="text-decoration: none; color: black; font-size: 24px; font-weight: 500;"
                                href="{{ route('transaksi.dashboard') }}">Transaski</a>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'pelanggan')
                        <div class="btn">
                            <a style="text-decoration: none; color: black; font-size: 24px; font-weight: 500;"
                                href="{{ route('dashboard.pelanggan') }}">Transaski</a>
                        </div>
                    @endif
                    <div class="btn">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit"
                                style="text-decoration: none; color: black; font-size: 24px; font-weight: 500; background-color: white; border: none;">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mx-4">
                <div>
                    <img src="{{ asset('assets/gambar/profile.png') }}" width="60" style="border-radius: 50%"
                        alt="" srcset="">
                </div>
            </div>
        </nav>
        <main class="d-flex flex-row my-5 mx-5">
            @include('validation.messages')
            @include('sweetalert::alert')
            @yield('content')
        </main>
    </div>


    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/jQuery.js') }}"></script>
    <script>
        new DataTable('#myTable');
    </script>

</body>

</html>
