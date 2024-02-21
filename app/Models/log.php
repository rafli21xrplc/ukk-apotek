<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class log extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_log',
        'method',
        'message',
        'url',
        'id_user'
    ];

    protected $guarded = [];

    protected $table = "log";
    protected $primaryKey = 'id_log';
    public $incrementing = false;

}
