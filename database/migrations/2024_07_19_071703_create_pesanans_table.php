<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('pesanan_id')->unique();
            $table->foreignId('pembeli_id')->constrained('users_pelanggan')->onDelete('cascade');
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->string('outlet_code');
            $table->integer('qty');
            $table->bigInteger('amount');
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->dateTime('tanggal_pesanan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pesanan');
    }
};
