<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ref_Provinsi extends Model
{
    use HasFactory;

    protected $table        = 'ref_propinsi';
    protected $primaryKey   = 'kode_propinsi';
    protected $guarded      = ['id', 'created_at'];
}
