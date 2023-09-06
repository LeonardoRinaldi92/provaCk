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
        Schema::create('cocktail_equipements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cocktail_id');
            $table->foreign('cocktail_id')->references('id')->on('cocktails')->onDelete('cascade');
            $table->unsignedBigInteger('equipement_id');
            $table->foreign('equipement_id')->references('id')->on('equipements')->onDelete('cascade');
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
        Schema::dropIfExists('cocktail_equipement');
    }
};
