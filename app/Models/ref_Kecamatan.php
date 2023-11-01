<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_Kecamatan extends Model
{
    use HasFactory;

    protected $table        = 'ref_kecamatan';
    protected $primaryKey   = 'kode_kecamatan';
    protected $guarded      = ['id', 'created_at'];
}
