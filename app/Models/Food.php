<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable=['name', 'food_categories_id', 'raw_material', 'price'];

    public function foodCategory(){
        return $this->belongsTo(FoodCategories::class);
    }
}
