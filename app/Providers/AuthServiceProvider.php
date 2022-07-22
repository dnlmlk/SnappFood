<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use App\Policies\CartPolicy;
use App\Policies\CommentPolicy;
use App\Policies\SellerPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        Restaurant::class => SellerPolicy::class,
        Order::class => CartPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('store', function (User $user, Order $order){
            if($order->user_id === $user->id ) {
                if ($order->customer_status == 'paid') {
                    if ($order->seller_status == 'delivered') return Response::allow();
                    return Response::deny('this food not delivered to you yet');
                }
                return Response::deny("you don't pay this cart yet");
            }
            return Response::deny("this isn't your cart");
        });
    }
}
