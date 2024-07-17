<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Master_Pembeli extends Model
{
    use HasFactory;

    protected $table = 'invoice_master_pembeli';
    protected $primaryKey = 'invoice_no'; // Nama kolom primary key
    public $incrementing = false; // Non-incrementing atau bukan auto-increment
    protected $keyType = 'string'; // Tipe data primary key adalah string

    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
