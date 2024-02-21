<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['id_pembayaran', 'nama_pembayaran'];
    protected $table = "pembayaran";
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false;
}
