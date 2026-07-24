<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Studio;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'studio'])
            ->latest()
            ->get();

        $totalBookings = $bookings->count();
        $pendingCount = $bookings->where('status', 'Pending')->count();
        $pendingBookings = $bookings->where('status', 'Pending')->take(5);

        $chartData = Studio::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->get()
            ->map(function ($studio) {
                return [
                    'nama' => $studio->nama_studio,
                    'jumlah' => $studio->bookings_count,
                ];
            });

        return view('admin.dashboard', compact('bookings', 'totalBookings', 'pendingCount', 'pendingBookings', 'chartData'));
    }
}