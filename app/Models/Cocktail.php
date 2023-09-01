<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'preparation', 'avg_ABV', 'official_IBA','straw', 'glass_id', 'ice_id', 'garnish','image'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

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
        return $this->belongsToMany(Equipment::class, 'cocktail_equipement', 'cocktail_id', 'equipement_id');
    }
}
