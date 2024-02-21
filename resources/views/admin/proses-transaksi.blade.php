@extends('layouts.dashboard-layout')

@section('content')
    <div class="w-100 px-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-weight: 500">Proses Transaksi</h1>
            </div>
        </div>
        <div class="my-4 py-5 px-5" style="background-color: white; border-radius: 10px">
            <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th class="px-6 py-3">
                            No
                        </th>
                        <th class="px-6 py-3">
                            Nama Pelanggan
                        </th>
                        <th class="px-6 py-3">
                            Jenis Pembayaran
                        </th>
                        <th class="px-6 py-3">
                            Nama Obat
                        </th>
                        <th class="px-6 py-3">
                            Tanggal
                        </th>
                        <th class="px-6 py-3">
                            Jumlah
                        </th>
                        <th class="px-6 py-3">
                            Total
                        </th>
                        <th class="px-6 py-3">
                            Action
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
                                {{ \Carbon\Carbon::parse($item->tanggal)->formatLocalized('%d %B %Y') }}
                            </td>
                            <td>
                                {{ $item->jumlah }}
                            </td>
                            <td>
                                {{ number_format($item->total, 2, ',', '.') }}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <form action="{{ route('approve.obat.admin', $item->id_penjualan) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-success" type="submit">Setujui</button>
                                    </form>
                                    <form action="{{ route('decline.obat.admin', $item->id_penjualan) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-danger" type="submit">Tolak</button>
                                    </form>
                                </div>
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
            </table>
        </div>
    </div>
@endsection
