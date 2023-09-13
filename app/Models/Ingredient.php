<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $primaryKey = 'cocktail_id'; // Specifica la chiave primaria personalizzata

    protected $fillable = ['cocktail_id', 'ingredientable_type', 'ingredientable_id', 'quantity', 'quantity_type'];

    public function ingredientable()
    {
        return $this->morphTo();
    }

    public function cocktail()
    {
        return $this->belongsTo(Cocktail::class, 'cocktail_id');
    }

    public function getSingleQuantity()
    {
        $formattedABV = number_format($this->quantity, 1);
        
        if (strpos($formattedABV, '.0') !== false) {
            return (int)$this->quantity;
        }
    
        return $formattedABV ;
    }
}
