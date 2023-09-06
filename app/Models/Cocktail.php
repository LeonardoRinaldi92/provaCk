<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'preparation', 'avg_ABV', 'official_IBA','straw', 'glass_id', 'ice_id', 'garnish','image','variation', 'slug'];


    public function glass()
    {
        return $this->belongsTo(Glass::class);
    }

    public function ice()
    {
        return $this->belongsTo(Ice::class);
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipement::class, 'cocktail_equipements', 'cocktail_id', 'equipement_id');
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function variations()
    {
        return $this->hasMany(Cocktail::class, 'variation');
    }

    public function originalCocktail()
    {
        return $this->belongsTo(Cocktail::class, 'variation');
    }

}
