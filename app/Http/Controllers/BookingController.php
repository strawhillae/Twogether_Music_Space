<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Studio;
use App\Notifications\PaymentVerified;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'studio'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $studios = Studio::where('status', 'Tersedia')->get();
        return view('user.bookings.create', compact('studios'));
    }

    public function store(Request $request)
    {
        $studio = Studio::findOrFail($request->studio_id);

        if ($studio->jenis === 'Recording') {
            $request->validate([
                'studio_id' => 'required',
                'tanggal' => 'required|date',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required|after:jam_mulai',
            ]);

            $bentrok = Booking::where('studio_id', $request->studio_id)
                ->where('tanggal', $request->tanggal)
                ->where('status', '!=', 'Ditolak')
                ->where(function ($query) use ($request) {
                    $query->where('jam_mulai', '<', $request->jam_selesai)
                          ->where('jam_selesai', '>', $request->jam_mulai);
                })
                ->exists();

            if ($bentrok) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Maaf, studio ini sudah dibooking pada jam tersebut. Silakan pilih jam lain.');
            }

            Booking::create([
                'user_id' => auth()->id(),
                'studio_id' => $request->studio_id,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'status' => 'Pending',
                'total_harga' => 0,
            ]);
        } else {
            $request->validate([
                'studio_id' => 'required',
                'tanggal' => 'required|date',
                'durasi_bulan' => 'required|integer|min:1',
            ]);

            $tanggalSelesai = Carbon::parse($request->tanggal)->addMonths((int) $request->durasi_bulan);

            $bentrok = Booking::where('studio_id', $request->studio_id)
                ->where('status', '!=', 'Ditolak')
                ->whereNotNull('tanggal_selesai')
                ->where(function ($query) use ($request, $tanggalSelesai) {
                    $query->where('tanggal', '<', $tanggalSelesai)
                          ->where('tanggal_selesai', '>', $request->tanggal);
                })
                ->exists();

            if ($bentrok) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Maaf, studio ini sudah disewa pada rentang tanggal tersebut. Silakan pilih tanggal lain.');
            }

            Booking::create([
                'user_id' => auth()->id(),
                'studio_id' => $request->studio_id,
                'tanggal' => $request->tanggal,
                'durasi_bulan' => $request->durasi_bulan,
                'tanggal_selesai' => $tanggalSelesai,
                'status' => 'Pending',
                'total_harga' => 0,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil dibuat. Menunggu konfirmasi admin.');
    }

    public function approve(Booking $booking)
    {
        $booking->load('studio');
        $studio = $booking->studio;

        if ($studio->jenis === 'Recording') {
            $mulai = Carbon::parse($booking->jam_mulai);
            $selesai = Carbon::parse($booking->jam_selesai);
            $totalJam = abs($selesai->diffInHours($mulai));
            $subtotal = $studio->harga * $totalJam;
        } else {
            $subtotal = $studio->harga * $booking->durasi_bulan;
        }

        $taxRate = config('pricing.tax_rate');
        $taxAmount = round($subtotal * $taxRate);
        $totalHarga = $subtotal + $taxAmount;

        $booking->update([
            'status' => 'Disetujui',
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil disetujui.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'Ditolak']);
        return redirect()->back()->with('success', 'Reservasi ditolak.');
    }

    public function verify(Booking $booking)
    {
        $booking->update(['status' => 'Selesai']);

        $booking->load(['user', 'studio']);
        $booking->user->notify(new PaymentVerified($booking));

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }
}