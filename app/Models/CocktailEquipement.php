<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocktailEquipement extends Model
{
    use HasFactory;

    protected $fillable = ['cocktail_id', 'equipment_id'];

    // Definisci le relazioni con gli altri modelli, se necessario.
}
