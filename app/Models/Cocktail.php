<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'preparation', 'avg_ABV', 'official_IBA','straw'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function glass()
    {
        return $this->belongsTo(Glass::class);
    }
}
