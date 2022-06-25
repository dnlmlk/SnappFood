<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'restaurant_categories_id', 'phone_number', 'address', 'account_number'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function restaurantCategory(){
        return $this->belongsTo(RestaurantCategories::class);
    }
}
