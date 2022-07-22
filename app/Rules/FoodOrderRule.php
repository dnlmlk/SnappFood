<?php

namespace App\Rules;

use App\Models\Order;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class FoodOrderRule implements Rule
{

    private $order_id;
    private $food_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($cart_id, $food_id)
    {
        $this->food_id = $food_id;
        $this->order_id = $cart_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $foods = Order::find($this->order_id)->foods->first()->pivot->pluck('food_id')->toArray();
        if (in_array($this->food_id, $foods)) return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "this food isn't exists in given cart";
    }
}
