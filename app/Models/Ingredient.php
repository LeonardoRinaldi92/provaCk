<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ingredientable_type', 'ingredientable_id'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function ingredientable()
    {
        return $this->morphTo();
    }
}
