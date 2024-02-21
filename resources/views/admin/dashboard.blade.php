@extends('layouts.dashboard-layout')

@section('content')
    <div class="w-100">
        <div>
            <h1>Dashboard</h1>
        </div>
        <div class="my-5">
            <section class="section" id="demo">
                <div class="container-fluid">
                    <div class="row gap-2 justify-content-center">
                        <div class="col-lg-3 col-sm-6 bg-white" style="border-radius: 20px">
                            <div class="demo-box text-center p-3 mt-4">
                                <div class="position-relative demo-content">
                                    <div class="demo-overlay">
                                        <div class="mt-3" style="text-decoration: none;">
                                            <h2 class="font-18" style="text-decoration: none;">Total User
                                            </h2>
                                        </div>
                                        <div class="mt-3" style="text-decoration: none;">
                                            <h2 class="font-18" style="text-decoration: none;">{{ $totalUser }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 bg-white" style="border-radius: 20px">
                            <div class="demo-box text-center p-3 mt-4">
                                <div class="position-relative demo-content">
                                    <div class="demo-overlay">
                                        <div class="mt-3" style="text-decoration: none;">
                                            <h2 class="font-18" style="text-decoration: none;">Total Transaksi
                                            </h2>
                                        </div>
                                        <div class="mt-3" style="text-decoration: none;">
                                            <h2 class="font-18" style="text-decoration: none;">{{ $totalPembayaran }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 bg-white" style="border-radius: 20px">
                            <div class="demo-box text-center p-3 mt-4">
                                <div class="position-relative demo-content">
                                    <div class="demo-overlay">
                                        <div class="mt-3" style="text-decoration: none;">
                                            <h2 class="font-18" style="text-decoration: none;">Total Obat
                                            </h2>
                                        </div>
                                        <div class="mt-3" style="text-decoration: none;">
                                            <h2 class="font-18" style="text-decoration: none;">{{ $totalObat }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid my-5">
                    <div class="row gap-2 justify-content-center">
                        @forelse ($user as $item)
                            <div class="col-lg-3 col-sm-6 bg-white" style="border-radius: 20px">
                                <div class="demo-box text-center p-3 mt-4">
                                    <div class="position-relative demo-content">
                                        <div class="demo-overlay">
                                            <div class="mt-3" style="text-decoration: none;">
                                                <h2 class="font-18" style="text-decoration: none;">{{ $item->nama_user }}
                                                </h2>
                                            </div>
                                            <div class="mt-3" style="text-decoration: none;">
                                                <a class="btn btn-warning" href="{{ route('log.admin', $item->id_user) }}">Log User</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
