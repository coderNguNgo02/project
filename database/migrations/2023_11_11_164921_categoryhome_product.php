<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categoryhome_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('id_prd');
            $table->foreign('category_id')->references('category_id')->on('categoriehome')->onDelete('cascade');
            $table->foreign('id_prd')->references('id_prd')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_product');
    }
};
