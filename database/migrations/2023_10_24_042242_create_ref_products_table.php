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
        Schema::create('ref_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('kategori_products');
            $table->string('sku');
            $table->string('nama_product');
            $table->string('slug')->unique();
            $table->string('harga');
            $table->text('deskripsi');
            $table->string('thumbnail');
            $table->text('path_thumbnail');
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
        Schema::dropIfExists('ref_products');
    }
};
