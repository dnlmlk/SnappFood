<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Schedule extends Model
{

    use HasFactory;

    protected $fillable=['restaurant_id', 'saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }


    public function setSaturdayAttribute($value)
    {
        if ($value == ',') $value = null;
        $this->attributes['saturday'] = $value;
    }

    public function getSaturdayAttribute($value)
    {
        if ($value != null)
            return explode(',', $value);
    }

    public function setSundayAttribute($value)
    {
        if ($value == ',') $value = null;
        $this->attributes['sunday'] = $value;
    }

    public function getSundayAttribute($value)
    {
        if ($value != null)
            return explode(',', $value);
    }

    public function setMondayAttribute($value)
    {
        if ($value == ',') $value = null;
        $this->attributes['monday'] = $value;
    }

    public function getMondayAttribute($value)
    {
        if ($value != null)
            return explode(',', $value);
    }

    public function setTuesdayAttribute($value)
    {
        if ($value == ',') $value = null;
        $this->attributes['tuesday'] = $value;
    }

    public function getTuesdayAttribute($value)
    {
        if ($value != null)
            return explode(',', $value);
    }

    public function setWednesdayAttribute($value)
    {
        if ($value == ',') $value = null;
        $this->attributes['wednesday'] = $value;
    }

    public function getWednesdayAttribute($value)
    {
        if ($value != null)
            return explode(',', $value);
    }

    public function setThursdayAttribute($value)
    {
        if ($value == ',') $value = null;
        $this->attributes['thursday'] = $value;
    }

    public function getThursdayAttribute($value)
    {
        if ($value != null)
            return explode(',', $value);
    }

    public function setFridayAttribute($value)
    {
        if ($value == ',') $value = null;
        $this->attributes['friday'] = $value;
    }

    public function getFridayAttribute($value)
    {
        if ($value != null)
            return explode(',', $value);
    }

}
