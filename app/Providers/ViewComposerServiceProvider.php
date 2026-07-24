<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Booking;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('components.admin-topbar', function ($view) {
            $pendingBookings = Booking::with(['user', 'studio'])
                ->where('status', 'Pending')
                ->latest()
                ->take(10)
                ->get();

            $view->with([
                'pendingBookings' => $pendingBookings,
                'pendingCount' => $pendingBookings->count(),
            ]);
        });
    }
}