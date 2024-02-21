<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class obat extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['kode_obat', 'gambar','nama_obat', 'harga', 'keterangan', 'stok', 'exp', 'id_kategori'];
    protected $table = "obat";
    protected $primaryKey = 'kode_obat';
    public $incrementing = false;


    public function kategori():HasOne
    {
        return $this->hasOne(kategori::class, 'id_kategori', 'id_kategori');
    }
}
