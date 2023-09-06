<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugar extends Model
{
    use HasFactory;

    protected $table = 'sugars';

    protected $fillable = ['name'];

    public function ingredients()
    {
        return $this->morphMany(Ingredient::class, 'ingredientable');
    }

    public function tables()
    {
        return 'Zuccheri';
    }
}
