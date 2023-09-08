<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlcoolCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function alcools()
    {
        return $this->hasMany(Alcool::class, 'alcool_categories_id')->onDelete('cascade');
    }
}

