<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategories extends Model
{
    use HasFactory;

    public function foods(){
        return $this->hasMany(Food::class, 'food_categories_id', 'id');
    }
}
