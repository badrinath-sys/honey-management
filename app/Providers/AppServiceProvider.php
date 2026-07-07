<?php
namespace App\Providers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {

            $wishlistCount = 0;

            if (Auth::guard('customer')->check()) {

                $wishlistCount = Wishlist::where(
                    'customer_id',
                    Auth::guard('customer')->id()
                )->count();
            }

            $view->with('wishlistCount', $wishlistCount);

        });
    }
}
