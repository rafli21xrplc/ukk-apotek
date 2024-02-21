<?php

namespace App\Http\Controllers\Pelanggan;

use App\Events\actionListener;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiRequest;
use App\Models\obat;
use App\Models\pelanggan;
use App\Models\pembayaran;
use App\Models\penjualan;
use App\Models\User;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('pelanggan');
    }

    protected function index(Request $request)
    {
        event(new actionListener(Auth::user()->id_user, $request->getMethod(), $request->getPathInfo(), 'akses dashboard'));
        $user = User::all();
        $pelanggan = pelanggan::all();
        $pembayaran = pembayaran::all();
        $obat = obat::all();

        $penjualan = penjualan::with(['pelanggan', 'pembayaran', 'obat', 'user'])->where('id_pelanggan', Auth::user()->id_pelanggan)->orderBy('created_at', 'desc')->get();
        return view('pelanggan.dashboard', compact('user', 'pelanggan', 'pembayaran', 'obat', 'penjualan'));
    }

    protected function tambah(TransaksiRequest $request)
    {
        $request->validated();
        try {
            $obat = obat::with('kategori')->find($request->obat);
            $jumlah_int = intval($request->jumlah);
            if ($jumlah_int > $obat->stok) {
                return redirect()->back()->with('error', 'jumlah melebihi stok');
            } else {
                if ($jumlah_int > $obat->stok) {
                    $stokbaru = $jumlah_int - $obat->stok;
                } else {
                    $stokbaru = $obat->stok - $jumlah_int;
                }
            }
            if ($obat->stok == 0) {
                return redirect()->back()->with('error', 'stok kosong');
            }

            event(new actionListener(Auth::user()->id_user, $request->getMethod(), $request->getPathInfo(), 'menyimpan data transaksi'));
            $total = $obat->harga * $request->jumlah;
            penjualan::create(
                [
                    'id_penjualan' => Str::uuid(),
                    'tanggal' => Carbon::now()->toDate(),
                    'jumlah' => $request->jumlah,
                    'total' => $total,
                    'id_user' => $request->user,
                    'id_pembayaran' => $request->pembayaran,
                    'kode_obat' => $request->obat,
                    'id_pelanggan' => Auth::user()->id_pelanggan,
                    'proses' => 'menunggu'
                ]
            );

            $obat->update([
                'stok' => $stokbaru
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Transaksi gagal dibuat');
        }
        return redirect()->back()->with('success', 'Transaksi berhasil dibuat mohon menunggu persetujuan');
    }

    protected function generate(string $id, Request $request)
    {
        $penjualan = penjualan::find($id);
        if ($penjualan->id_user == null) {
            return redirect()->back()->with('error', 'Transaksi dalam proses.');
        }
        event(new actionListener(Auth::user()->id_user, $request->getMethod(), $request->getPathInfo(), 'cetak data transaksi'));
        $obat = obat::with('kategori')->find($penjualan->kode_obat);
        $penjual = User::find($penjualan->id_user);
        $pelanggan = pelanggan::find($penjualan->id_pelanggan);

        $penjualan = [
            "Code" => Str::uuid(),
            'user' => $pelanggan->nama_pelanggan,
            'obat' => $obat->nama_obat,
            'jumlah' => $penjualan->jumlah,
            'total' => $penjualan->total,
            'kategori' => $obat->kategori->nama_kategori,
            'keterangan' => $obat->keterangan,
            'status' => $penjualan->proses,
            'color' => $penjualan->proses  == 'berhasil' ? "green" : "red"
        ];

        $pdf = PDF::loadView('pdf.transaksi-pelanggan', compact('penjualan'));

        return $pdf->download('transaksi.pdf');
    }
}
