<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugar extends Model
{
    use HasFactory;

<<<<<<< HEAD
=======
    protected $table = 'sugars';

>>>>>>> 0b8d336d4c5fdec49ccf772b9b399990650edf44
    protected $fillable = ['name'];

    public function ingredient()
    {
        return $this->morphOne(Ingredient::class, 'ingredientable');
    }
}
