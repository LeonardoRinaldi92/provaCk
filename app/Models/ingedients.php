<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingedients extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function ingredientable()
    {
        return $this->morphTo();
    }

    
}
