<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'restaurant_categories_id', 'phone_number', 'account_number', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function restaurantCategory(){
        return $this->belongsTo(RestaurantCategories::class, 'restaurant_categories_id', 'id');
    }

    public function foods(){
        return $this->hasMany(Food::class);
    }

    public function schedule(){
        return $this->hasOne(Schedule::class);
    }

    public function address(){
        return $this->morphOne(Address::class, 'addressable');
    }
}
