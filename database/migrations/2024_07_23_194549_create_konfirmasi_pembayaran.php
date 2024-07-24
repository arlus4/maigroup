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
        Schema::create('konfirmasi_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('brand_code');
            $table->string('invoice_no');
            $table->integer('id_bank_tokoseru');
            $table->bigInteger('user_request')->nullable();
            $table->integer('point_request')->nullable();
            $table->string('jumlah_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->text('path_bukti_pembayaran')->nullable();
            $table->enum('status', ['0', '1', '2', '3', '4'])->default('0');
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
        Schema::dropIfExists('konfirmasi_pembayaran');
    }
};
