<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
<<<<<<< HEAD
    protected $fillable = ['name'];
=======
    use HasFactory;

    protected $fillable = ['name', 'description', 'preparation', 'avg_ABV', 'official_IBA'];
>>>>>>> 0b8d336d4c5fdec49ccf772b9b399990650edf44

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
