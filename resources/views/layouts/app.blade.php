<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
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

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background-color: whitesmoke; scroll-">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="d-flex flex-row gap-2">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/gambar/icon.png') }}" width="60" alt="" srcset="">
                    </div>
                    <div class="d-flex align-items-center">
                        <h4 style="font-weight: bold">
                            IndoPotek
                        </h4>
                    </div>
                </div>
            </div>
        </nav>
        <main class="d-flex flex-row" style="height: 90vh;">
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

    <script>
        $('.close-button').click(function() {
            $('#kelas-update').removeClass('flex').addClass('hidden');
        });

        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var kelas = $(this).data('kelas');
            var kompetensi = $(this).data('kompetensi');

            var formUpdate = $('#kelas-update .form-edit-kelas');

            formUpdate.find('input[name="id"]').val(id);
            formUpdate.find('input[name="kelas"]').val(kelas);
            formUpdate.find('input[name="kompetensi"]').val(kompetensi);

            $('#kelas-update').removeClass('hidden').addClass('flex');
        });
    </script>
</body>

</html>
