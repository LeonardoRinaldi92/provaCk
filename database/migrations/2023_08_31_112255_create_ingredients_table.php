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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->unsignedBigInteger('cocktail_id');
            $table->foreign('cocktail_id')->references('id')->on('cocktails')->onDelete('cascade');
            $table->string('ingredientable_type'); // Aggiungi questa colonna
            $table->unsignedBigInteger('ingredientable_id');
            $table->decimal('quantity', 4, 1); // Aggiungi questa colonna
            $table->enum('quantity_type', ['ml', 'oz', 'dash', 'spoon', 'slice', 'cove'])->nullable();
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
        Schema::dropIfExists('ingredients');
    }
};
