<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        .content {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>LAPORAN PEMBAYARAN APOTEK</h1>
        </div>

        <div class="content">
            <h2>Invoice</h2>
            <p>Date: {{ \Carbon\Carbon::parse(date('Y-m-d'))->formatLocalized('%d %B %Y') }}
            </p>

            <table>
                <thead>
                    <tr>
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
                                {{ $item->total }}
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

        <div class="footer">
            <p>Developer By MSR</p>
        </div>
    </div>
</body>

</html>
