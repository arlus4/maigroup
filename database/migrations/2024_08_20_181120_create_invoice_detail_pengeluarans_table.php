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
        Schema::create('invoice_detail_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->constrained('invoice_master_pengeluaran')->onDelete('cascade');
            $table->string('outlet_code')->constrained('outlets')->onDelete('cascade');
            $table->bigInteger('qty');
            $table->string('unit');
            $table->bigInteger('price');
            $table->bigInteger('amount');
            $table->foreignId('produk_id')->constrained('product_outlets')->onDelete('cascade')->nullable();
            $table->foreignId('bahan_id')->constrained('product_bahan')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('invoice_detail_pengeluaran');
    }
};
