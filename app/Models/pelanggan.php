<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['id_pelanggan', 'nama_pelanggan', 'username', 'password', 'alamat'];
    protected $table = "pelanggan";
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
}
