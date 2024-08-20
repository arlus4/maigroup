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
        Schema::create('invoice_master_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->string('outlet_code')->constrained('outlets')->onDelete('cascade');
            $table->bigInteger('qty');
            $table->bigInteger('amount');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('invoice_master_pengeluaran');
    }
};
