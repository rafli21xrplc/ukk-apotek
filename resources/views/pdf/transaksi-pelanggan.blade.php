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
                            Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Pelanggan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Obat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Obat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td>
                            {{ $penjualan['Code'] }}
                        </td>
                        <td>
                            {{ $penjualan['user'] }}
                        </td>
                        <td>
                            {{ $penjualan['obat'] }}
                        </td>
                        <td>
                            {{ $penjualan['jumlah'] }}
                        </td>
                        <td>
                            {{ number_format($penjualan['total'], 2, ',', '.') }}
                        </td>
                        <td>
                            {{ $penjualan['kategori'] }}
                        </td>
                        <td>
                            {{ $penjualan['keterangan'] }}
                        </td>
                        <td>
                            <p style="color: {{ $penjualan['color'] }}">{{ $penjualan['status'] }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
