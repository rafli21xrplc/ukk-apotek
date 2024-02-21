<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriObatRequest;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriObatController extends Controller
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
        $kategori = kategori::orderBy('created_at', 'desc')->get();
        return view('admin.kategori-obat', compact('kategori'));
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
    public function store(KategoriObatRequest $request)
    {
        $request->validated();
        try {
            kategori::create(['id_kategori' => Str::uuid(), 'nama_kategori' => $request->nama_kategori]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal di buat');
        }
        return redirect()->back()->with('success', 'berhasil di buat');
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
    public function update(KategoriObatRequest $request)
    {
        $request->validated();
        try {
            $data = kategori::find($request->id);
            $data->update([
                'nama_kategori' => $request->nama_kategori ?? $data->nama_kategori
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
            kategori::find($id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal di delete');
        }
        return redirect()->back()->with('success', 'berhasil di delete');
    }
}
