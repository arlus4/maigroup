<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_KuotaPoint extends Model
{
    use HasFactory;

    public $timestamps      = false;
    protected $table        = 'ref_kuota_point';
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];
}
