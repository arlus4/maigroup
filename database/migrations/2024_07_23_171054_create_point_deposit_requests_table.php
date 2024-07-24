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
        Schema::create('point_deposit_request', function (Blueprint $table) {
            $table->id();
            $table->string('brand_code');
            $table->string('invoice_no');
            $table->integer('point_request')->nullable();
            $table->bigInteger('update_by')->nullable();
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
        Schema::dropIfExists('point_deposit_request');
    }
};
