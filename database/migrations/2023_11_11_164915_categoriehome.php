<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categoriehome', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
