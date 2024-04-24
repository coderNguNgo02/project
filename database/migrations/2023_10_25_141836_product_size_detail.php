<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_size_detail', function (Blueprint $table) {
            $table->id("prd_size_detail");
            $table->unsignedBigInteger('id_prd');
            $table->foreign('id_prd')->references('id_prd')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('id_size');
            $table->foreign('id_size')->references('id_size')->on('size_product')->onDelete('cascade');
            $table->string('qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_size_detail');
    }
};
