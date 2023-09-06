<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'slug'];

    public function cocktails()
    {
        return $this->belongsToMany(Cocktail::class, 'cocktail_equipement', 'equipement_id', 'cocktail_id');
    }

    public function tables()
    {
        return 'Strumenti';
    }
}
