<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchDateRequest;
use App\Http\Requests\TransaksiRequest;
use App\Models\obat;
use App\Models\pelanggan;
use App\Models\pembayaran;
use App\Models\penjualan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('petugas');
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = User::all();
        $pelanggan = pelanggan::all();
        $pembayaran = pembayaran::all();
        $obat = obat::all();
        $penjualan = penjualan::with(['pelanggan', 'pembayaran', 'obat', 'user'])->orderBy('created_at', 'desc')->get();
        return view('petugas.transaksi', compact('user', 'pelanggan', 'pembayaran', 'obat', 'penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiRequest $request)
    {
        try {
            $request->validated();
            $obat = obat::find($request->obat);
            $jumlah_int = intval($request->jumlah);
            if ($jumlah_int < $obat->stok) {
                $stokbaru = $obat->stok - $jumlah_int;
            } else {
                $stokbaru = $jumlah_int - $obat->stok;
            }
            if ($obat->stok == 0) {
                return redirect()->back()->with('error', 'jumlah melebihi stok');
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

            $penjualan = penjualan::with(['pelanggan', 'pembayaran', 'obat', 'user'])->whereBetween('created_at', [$start_date, $end_date])->get();

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
