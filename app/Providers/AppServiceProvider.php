<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Ticket;
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
        $pendingOrderCount = Order::where('status', 1)->count();
        $pendingTicketCount = Ticket::where('status', 1)->count();

        View::share([
            'pendingOrderCount' => $pendingOrderCount,
            'pendingTicketCount' => $pendingTicketCount,
        ]);
    }
}
