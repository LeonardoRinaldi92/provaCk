<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alcool extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['name'];
=======
    protected $fillable = ['name','ABV'];
>>>>>>> 0b8d336d4c5fdec49ccf772b9b399990650edf44

    public function ingredient()
    {
        return $this->morphOne(Ingredient::class, 'ingredientable');
    }
<<<<<<< HEAD
=======
	
>>>>>>> 0b8d336d4c5fdec49ccf772b9b399990650edf44
}
