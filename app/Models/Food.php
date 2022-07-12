<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable=['name', 'food_categories_id', 'raw_material', 'price', 'discount_id'];
    protected $appends = ['discounted_price'];
    protected $visible = ['discounted_price', 'count', 'pivot_count'];

    public function getDiscountedPriceAttribute(){
        return $this->attributes['price'] * ((100 - Discount::find($this->attributes['discount_id'])->value) / 100);
    }

    public function foodCategory(){
        return $this->belongsTo(FoodCategories::class, 'food_categories_id', 'id');
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('count');
    }
}
