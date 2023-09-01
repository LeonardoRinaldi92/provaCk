<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ABV','description'];

    public function ingredient()
    {
        return $this->morphOne(Ingredient::class, 'ingredientable');
    }
}
