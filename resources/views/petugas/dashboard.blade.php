@extends('layouts.dashboard-layout')

@section('content')
<div class="w-100 px-5">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 style="font-weight: 500">Transaksi</h1>
        </div>
        <div class="d-flex justify-center gap-3 flex-row">
            <form class="d-flex justify-content-center gap-1 flex-row align-items-center mx-2"
                action="{{ route('search.date.petugas') }}" method="post">
                @csrf
                @method('POST')
                <div class="mx-3">
                    Search Range
                </div>
                <div>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div> - </div>
                <div>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <div>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Cari
                    </button>
                </div>
            </form>
            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#obat-modal">Tambah Transaksi
            </button>
            <a href="{{ route('generate.petugas') }}" class="btn btn-warning waves-effect waves-light text-white">Print
            </a>
        </div>
    </div>
    <div class="my-4 py-5 px-5" style="background-color: white; border-radius: 10px">
        <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Pelanggan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jenis Pembayaran
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Obat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Penjual
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penjualan as $index => $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $item->pelanggan->nama_pelanggan }}
                        </td>
                        <td>
                            {{ $item->pembayaran->nama_pembayaran }}
                        </td>
                        <td>
                            {{ $item->obat->nama_obat }}
                        </td>
                        <td>
                            {{ $item->user->nama_user }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->formatLocalized('%d %B %Y') }}
                        </td>
                        <td>
                            {{ $item->jumlah }}
                        </td>
                        <td>
                            {{ number_format($item->total, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <div class="my-5 flex justify-center w-full" style="min-height:16rem">
                                <div class="my-auto">
                                    <img width="250" src="{{ asset('assets/gambar/empty-data.png') }}"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
    </div>
</div>

<div id="obat-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="obat-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('tambah.transaksi.petugas') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Transaksi Obat</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">pelanggan</label>
                                <select name="pelanggan" class="form-control">
                                    @forelse ($pelanggan as $item)
                                        <option value="{{ $item->id_pelanggan }}">{{ $item->nama_pelanggan }}</option>
                                    @empty
                                        <option disabled value="">Empty</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">pembayaran</label>
                                <select name="pembayaran" class="form-control">
                                    @forelse ($pembayaran as $item)
                                        <option value="{{ $item->id_pembayaran }}">{{ $item->nama_pembayaran }}
                                        </option>
                                    @empty
                                        <option disabled value="">Empty</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">user</label>
                                <select name="user" class="form-control">
                                    @forelse ($user as $item)
                                        <option value="{{ $item->id_user }}">{{ $item->nama_user }}</option>
                                    @empty
                                        <option disabled value="">Empty</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">obat</label>
                                <select name="obat" class="form-control">
                                    @forelse ($obat as $item)
                                        <option value="{{ $item->kode_obat }}">{{ $item->nama_obat }}</option>
                                    @empty
                                        <option disabled value="">Empty</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light text-white">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
