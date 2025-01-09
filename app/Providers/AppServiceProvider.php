<?php

namespace App\Providers;

use App\Cart;
use App\Photo;
use App\Observers\CartObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Cart::observe(CartObserver::class);
        $photos = Photo::where('is_open', 1)->orderBy('created_at', 'DESC')->get();
        View::share('photos', $photos);
    }
}
