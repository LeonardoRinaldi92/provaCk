<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'preparation', 'avg_ABV'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
