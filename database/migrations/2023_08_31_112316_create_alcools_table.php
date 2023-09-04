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
        Schema::create('alcools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('alcool_categories_id');
            $table->foreign('alcool_categories_id')->references('id')->on('alcool_categories');
            $table->decimal('ABV', 3, 1);
            $table->string('description');
            $table->text('image');
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
        Schema::dropIfExists('alcools');
    }
};
