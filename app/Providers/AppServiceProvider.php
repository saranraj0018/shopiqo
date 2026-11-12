<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
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
        $pendingVendorCount = Admin::where('role_id', 2)->where('is_approved', false)->count();

        View::share([
            'pendingOrderCount' => $pendingOrderCount,
            'pendingTicketCount' => $pendingTicketCount,
            'pendingVendorCount' => $pendingVendorCount,
        ]);

        // The storefront navbar's scrollable category row — shared via a
        // composer (not View::share) so the query only runs on pages that
        // actually render the navbar.
        View::composer(
            ['frontend.components.navbar', 'frontend.components.guestnavbar'],
            function ($view) {
                $view->with(
                    'navCategories',
                    Category::whereNull('parent_id')->where('status', 1)->orderBy('name')->get()
                );
            }
        );
    }
}
