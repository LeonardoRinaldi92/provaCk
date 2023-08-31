<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipes extends Model
{
    use HasFactory;

    protected $fillable = ['cocktail_id', 'ingredient_id', 'quantity'];

    public function cocktail()
    {
        return $this->belongsTo(Cocktail::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
