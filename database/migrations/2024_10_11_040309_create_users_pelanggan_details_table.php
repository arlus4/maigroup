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
        Schema::create('users_pelanggan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('users_pelanggan')->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->text('path_avatar')->nullable();
            $table->string('nomor_ktp')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->foreignId('kode_propinsi')->nullable();
            $table->foreignId('kode_kotakab')->nullable();
            $table->foreignId('kode_kecamatan')->nullable();
            $table->foreignId('kode_kelurahan')->nullable();
            $table->foreignId('kodepos')->nullable();
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
        Schema::dropIfExists('users_pelanggan_details');
    }
};
