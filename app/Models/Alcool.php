<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alcool extends Model
{
    use HasFactory;

    protected $fillable = ['name','ABV','description','image'];

    public function ingredients()
    {
        return $this->morphMany(Ingredient::class, 'ingredientable');
    }

    public function category()
    {
        return $this->belongsTo(AlcoolCategory::class, 'alcool_categories_id');
    }
	
}
