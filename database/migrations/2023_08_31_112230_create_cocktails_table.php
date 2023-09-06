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
        Schema::create('cocktails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->text('preparation');
            $table->decimal('avg_ABV', 3, 1);
            $table->boolean('official_IBA')->nullable();
            $table->unsignedBigInteger('glass_id');
            $table->foreign('glass_id')->references('id')->on('glasses');
            $table->unsignedBigInteger('ice_id');
            $table->foreign('ice_id')->references('id')->on('ices');
            $table->unsignedBigInteger('variation')->nullable(); // Aggiungi la colonna "variation" nullable
            $table->foreign('variation')->references('id')->on('cocktails')->onDelete('set null'); // Chiave esterna per la stessa tabella cocktailsails
            $table->string('signature')->nullable();
            $table->string('garnish');
            $table->boolean('straw');
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
    
        // Drop the cocktail_equipement pivot table
        Schema::dropIfExists('cocktail_equipements');
    
        // Now drop the cocktails table
        Schema::dropIfExists('cocktails');
    }
};
