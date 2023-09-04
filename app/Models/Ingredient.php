<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ingredientable_type', 'ingredientable_id', 'quantity', 'quantity_type'];

    public function ingredientable()
    {
        return $this->morphTo();
    }

    public function cocktail()
    {
        return $this->belongsTo(Cocktail::class, 'cocktail_id');
    }
}
