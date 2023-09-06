<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ice extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','image', 'slug'];

    public function cocktails()
    {
        return $this->hasMany(Cocktail::class);
    }

    public function tables()
    {
        return 'Tipi di Ghiaccio';
    }
}
