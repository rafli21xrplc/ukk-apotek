<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class penjualan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['id_penjualan', 'tanggal', 'jumlah', 'total', 'id_user', 'id_pembayaran', 'kode_obat', 'id_pelanggan', 'proses'];
    protected $table = "penjualan";
    protected $primaryKey = 'id_penjualan';
    public $incrementing = false;

    public function pelanggan(): HasOne
    {
        return $this->hasOne(pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }

    public function obat(): HasOne
    {
        return $this->hasOne(obat::class, 'kode_obat', 'kode_obat');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }
}
