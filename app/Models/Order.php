<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'restaurant_id', 'cost', 'seller_status', 'customer_status', 'orders'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function foods(){
        return $this->belongsToMany(Food::class)->withPivot('count');
    }
}
