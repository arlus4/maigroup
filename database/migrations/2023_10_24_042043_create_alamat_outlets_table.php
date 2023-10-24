<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alamat_outlets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id');
            $table->foreignId('kode_propinsi');
            $table->foreignId('kode_kotakab');
            $table->foreignId('kode_kecamatan');
            $table->foreignId('kode_kelurahan');
            $table->foreignId('kodepos');
            $table->text('alamat_detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat_outlets');
    }
};
