<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'address', 'latitude', 'longitude', 'active'];
    protected $hidden = ['user_id', 'created_at', 'updated_at', 'active', 'user'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
