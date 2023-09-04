<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AromaticBitter extends Model
{
    use HasFactory;

    protected $table = 'aromatic_bitters';

    protected $fillable = ['name', 'ABV','description','image'];

    public function ingredients()
    {
        return $this->morphMany(Ingredient::class, 'ingredientable');
    }

    public function tables()
    {
        return 'Bitter Aromatici';
    }

    public function getSingleDigitABV()
    {
        $formattedABV = number_format($this->ABV, 1);
        
        if (strpos($formattedABV, '.0') !== false) {
            return (int)$this->ABV . ' %';
        }
    
        return $formattedABV . ' %';
    }
}
