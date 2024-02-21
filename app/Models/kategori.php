<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $fillable = ['id_kategori', 'nama_kategori'];
    protected $table = "kategori";
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
}
