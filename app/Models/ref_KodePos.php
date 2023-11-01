<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_KodePos extends Model
{
    use HasFactory;

    protected $table        = 'ref_kodepos';
    protected $primaryKey   = 'kodepos';
    protected $guarded      = ['id', 'created_at'];
}
