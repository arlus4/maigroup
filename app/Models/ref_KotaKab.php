<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_KotaKab extends Model
{
    use HasFactory;

    protected $table        = 'ref_kotakab';
    protected $primaryKey   = 'kode_kotakab';
    protected $guarded      = ['id', 'created_at'];
}
