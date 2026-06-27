<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {
            if (request()->is('admin/*')) {
                return;
            }
            
            $sessionId = session()->getId();
            $userId = auth()->id();
            
            $cart = \App\Models\Cart::when($userId, function($q) use ($userId) {
                    return $q->where('user_id', $userId);
                }, function($q) use ($sessionId) {
                    return $q->where('session_id', $sessionId);
                })
                ->first();
                
            $cartCount = $cart ? $cart->items()->sum('quantity') : 0;
            $view->with('cartCount', $cartCount);
        });
    }
}
