<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\penjualan;
use PDF;

class Generate extends Controller
{
    protected function generate()
    {
        try {
            $penjualan = penjualan::with(['pelanggan', 'pembayaran', 'obat', 'user'])->where('proses', 'berhasil')->get();

            if ($penjualan->count() == 0) {
                return redirect()->back()->with('error', 'data transaksi kosong.');
            }

            if (empty($penjualan)) {
                return redirect()->back()->with('warning', 'data kosong!');
            }

            $pdf = PDF::loadView('pdf.transaksi', compact('penjualan'));

            return $pdf->download('transaksi.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal generate pdf!');
        }
    }
}
