<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptController extends Controller
{
    public function download(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Struk hanya tersedia setelah pembayaran diverifikasi.');
        }

        $booking->load('studio', 'user');

        $pdf = Pdf::loadView('receipt.pdf', compact('booking'));

        return $pdf->download('Struk-Booking-' . $booking->id . '.pdf');
    }
}