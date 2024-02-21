<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


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
</head>

<body style="background-color: whitesmoke;">
    <div>
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
                <div>
                    @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 d-flex gap-3 flex-row">
                            @auth
                                <div>
                                    <a href="{{ url('/home') }}" style="text-decoration: none; color: black; font-size: 20px"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                                </div>
                            @else
                                <div>
                                    <a href="{{ route('login') }}" style="text-decoration: none; color: black; font-size: 20px"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                        in</a>
                                </div>

                                @if (Route::has('register'))
                                    <div>
                                        <a href="{{ route('register') }}" style="text-decoration: none; color: black; font-size: 20px"
                                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <div class="w-100 px-5 my-5 d-flex align-items-center justify-content-center flex-row">
            <div class="col-md-8 d-flex flex-row">
                <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                    <img src="{{ asset('assets/gambar/pimtracold.png') }}" width="500" alt="" srcset="">
                </div>
                <div class="d-flex justify-content-center align-items-center"
                    style="display: flex; flex-direction: column">
                    <div class="my-5">
                        <h3 style="font-weight: 800; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi
                            laborum, aliquam voluptatum debitis dolores illum ducimus necessitatibus nulla reprehenderit
                            repellendus!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/jQuery.js') }}"></script>

</body>

</html>
