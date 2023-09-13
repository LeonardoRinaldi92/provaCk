<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alcool extends Model
{
    use HasFactory;

    protected $fillable = ['name','ABV','description','image','alcool_categories_id', 'slug'];

    public function ingredients()
    {
        return $this->morphMany(Ingredient::class, 'ingredientable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // Ottieni tutti gli ingredienti associati a questo modello
            $ingredients = $model->ingredients;

            // Itera sugli ingredienti e elimina i cocktail associati
            foreach ($ingredients as $ingredient) {
                $cocktail = $ingredient->cocktail;
                if ($cocktail) {
                    $cocktail->delete();
                }
            }
        });
    } 


    public function category()
    {
        return $this->belongsTo(AlcoolCategory::class, 'alcool_categories_id');
    }

    public function tables()
    {
        return 'Alcolici';
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
