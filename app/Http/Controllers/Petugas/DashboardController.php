<?php

namespace App\Http\Controllers\Petugas;

use App\Events\actionListener;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SearchDateRequest;
use App\Http\Requests\TransaksiRequest;
use App\Models\obat;
use App\Models\pelanggan;
use App\Models\pembayaran;
use App\Models\penjualan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('petugas');
    }

    protected function index(Request $request)
    {
        event(new actionListener(Auth::user()->id_user, $request->getMethod(), $request->getPathInfo(), 'akses dashboard'));
        $user = User::all();
        $pelanggan = pelanggan::all();
        $pembayaran = pembayaran::all();
        $obat = obat::all();
        $penjualan = penjualan::with(['pelanggan', 'pembayaran', 'obat', 'user'])->where('proses', 'berhasil')->orderBy('created_at', 'desc')->get();
        return view('petugas.transaksi', compact('user', 'pelanggan', 'pembayaran', 'obat', 'penjualan'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiRequest $request)
    {
        $request->validated();
        try {
            event(new actionListener(Auth::user()->id_user, $request->getMethod(), $request->getPathInfo(), 'menyimpan data transaksi'));
            $obat = obat::find($request->obat);
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
                    'id_pelanggan' => $request->pelanggan
                ]
            );
            $obat->update([
                'stok' => $stokbaru
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Transaksi gagal dibuat');
        }
        return redirect()->back()->with('success', 'Transaksi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function filterDate(SearchDateRequest $request)
    {
        $request->validated();
        try {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $start_date = Carbon::parse($startDate)->startOfDay();
            $end_date = Carbon::parse($endDate)->endOfDay();

            $penjualan = penjualan::with(['pelanggan', 'pembayaran', 'obat', 'user'])->where('proses', 'berhasil')->whereBetween('created_at', [$start_date, $end_date])->get();

            $user = User::all();
            $pelanggan = pelanggan::all();
            $pembayaran = pembayaran::all();
            $obat = obat::all();
            return view('petugas.transaksi', compact('user', 'pelanggan', 'pembayaran', 'obat', 'penjualan'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Transaksi gagal di cari');
        }
    }
}
