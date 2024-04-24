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
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_prd');
            $table->unsignedBigInteger('id_cate');
            $table->foreign('id_cate')->references('id_cate')->on('categories')->onDelete('cascade');
            $table->string('name_prd');
            $table->string('brand_prd');
            $table->string('price_prd');
            $table->string('qty_prd');
            $table->string('desc_prd');
            $table->string('img_prd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
