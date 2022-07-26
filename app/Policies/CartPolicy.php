<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use function PHPUnit\Framework\isNull;

class CartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Order $order)
    {
        return $order->user_id === $user->id;

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Order $order)
    {
        if ($order != null) {
            if ($order->user_id === $user->id) {
                if ($order->customer_status == 'unpaid') return Response::allow();
                return Response::deny("this card is paid and you can't update it");
            }
            return Response::deny("this isn't your card");
        }
        return Response::deny("You don't have unpaid card");

    }


    public function pay(User $user, Order $order)
    {
        $thisDay = strtolower(Carbon::now()->isoFormat('dddd'));
        $thisHour = Carbon::now()->isoFormat('H');


        if($order->user_id === $user->id ) {
            if ($order->restaurant->status == 'open') {
                if ($order->restaurant->schedule->{$thisDay} != null) {
                    if ($thisHour <= $order->restaurant->schedule->{$thisDay}[1] && $thisHour >= $order->restaurant->schedule->{$thisDay}[0]) {
                        if ($order->customer_status == 'unpaid') return Response::allow();
                        return Response::deny('this cart is paid');
                    }
                    return Response::deny("restaurant not work now, that is open between {$order->restaurant->schedule->{$thisDay}[0]} to {$order->restaurant->schedule->{$thisDay}[1]}");
                }
                return Response::deny('the restaurant today is close');
            }
            return Response::deny('restaurant is close');
        }
        return Response::deny("this isn't your cart");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
