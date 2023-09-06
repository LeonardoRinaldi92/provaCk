<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soda extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','description'];

    public function ingredients()
    {
        return $this->morphMany(Ingredient::class, 'ingredientable');
    }

    public function tables()
    {
        return 'Sodati';
    }
}
