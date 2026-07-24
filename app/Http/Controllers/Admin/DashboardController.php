<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function exportPdf()
{
    $bookings = Booking::with(['studio', 'user'])->get();
    // sesuaikan data apa aja yang mau ditampilin di laporan

    $pdf = Pdf::loadView('admin.laporan.pdf', [
        'bookings' => $bookings,
        'tanggal' => now()->format('d-m-Y'),
    ]);

    return $pdf->download('laporan-dashboard-' . now()->format('Ymd') . '.pdf');
}
}