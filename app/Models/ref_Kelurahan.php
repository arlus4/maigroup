<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_Kelurahan extends Model
{
    use HasFactory;

    protected $table        = 'ref_kelurahan';
    protected $primaryKey   = 'kode_kelurahan';
    protected $guarded      = ['id', 'created_at'];
}
