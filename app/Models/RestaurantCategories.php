<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCategories extends Model
{
    use HasFactory;

    public function restaurants(){
        return $this->hasMany(Restaurant::class, 'restaurant_categories_id', 'id');
    }
}
