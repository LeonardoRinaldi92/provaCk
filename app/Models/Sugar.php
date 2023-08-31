<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugar extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function ingredient()
    {
        return $this->morphOne(Ingredient::class, 'ingredientable');
    }
}