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
        Schema::create('product_outlets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained('outlets');
            $table->foreignId('category_id')->constrained('kategori_products');
            $table->foreignId('product_id')->constrained('ref_products');
            $table->integer('jumlah');
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
        Schema::dropIfExists('product_outlets');
    }
};
