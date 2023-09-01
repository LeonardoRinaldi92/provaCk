<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ABV','description','image'];

    public function ingredient()
    {
        return $this->morphOne(Ingredient::class, 'ingredientable');
    }
}
