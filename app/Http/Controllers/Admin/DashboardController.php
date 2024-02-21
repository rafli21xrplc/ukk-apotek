<?php

namespace App\Http\Controllers\Admin;

use App\Events\actionListener;
use App\Http\Controllers\Controller;
use App\Models\log;
use App\Models\obat;
use App\Models\pembayaran;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    protected function index()
    {
        $user = User::with('log')->where('role', 'petugas')->orWhere('role', 'pelanggan')->get();
        $totalUser = $user->count();
        $totalPembayaran = pembayaran::count();
        $totalObat = obat::count();
        return view('admin.dashboard', compact('user', 'totalUser', 'totalPembayaran', 'totalObat'));
    }

    protected function log(string $id)
    {
        $log = log::where('id_user', $id)->get();
        return view('admin.log', compact('log'));
    }
}
