<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ObatRequest;
use App\Http\Requests\ObatUpdateRequest;
use Illuminate\Support\Str;
use App\Models\kategori;
use App\Models\obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obat = obat::with('kategori')->orderBy('created_at', 'desc')->get();
        $kategori = kategori::all();
        return view('admin.obat', compact('obat', 'kategori'));
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
    public function store(ObatRequest $request)
    {
        $request->validated();
        try {
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar')->store('images/obat', 'public');
            }
            obat::create([
                'kode_obat' => Str::uuid(),
                'gambar' => $gambar,
                'nama_obat' => $request->nama_obat,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'stok' => $request->stok,
                'exp' => $request->exp,
                'id_kategori' => $request->kategori
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal di tambahkan');
        }
        return redirect()->back()->with('success', 'berhasil di tambahkan');
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
    public function update(ObatUpdateRequest $request)
    {
        $request->validated();
        try {
            $data = obat::find($request->id);
            if ($request->hasFile('gambar')) {
                if ($request->gambar && Storage::disk('public')->exists($data->gambar)) {
                    Storage::disk('public')->delete($data->gambar);
                }
                $newImage = $request->file('gambar')->store('images/obat', 'public');
            }

            $data->update([
                'gambar' => $newImage ?? $data->gambar,
                'nama_obat' => $request->nama_obat ?? $data->nama_obat,
                'harga' => $request->harga ?? $data->harga,
                'keterangan' => $request->keterangan ?? $data->keterangan,
                'stok' => $request->stok ?? $data->stok,
                'exp' => $request->exp ?? $data->exp,
                'id_kategori' => $request->kategori ?? $data->id_kategori
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal di update');
        }
        return redirect()->back()->with('success', 'berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = obat::find($id);
            if ($data->gambar && Storage::disk('public')->exists($data->gambar)) {
                Storage::disk('public')->delete($data->gambar);
            }
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal di delete');
        }
        return redirect()->back()->with('success', 'berhasil di delete');
    }
}
