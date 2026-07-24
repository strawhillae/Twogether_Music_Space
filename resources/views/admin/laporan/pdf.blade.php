<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        h1 { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h1>Laporan Booking Studio</h1>
    <p>Tanggal cetak: {{ $tanggal }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Studio</th>
                <th>User</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Durasi (bln)</th>
                <th>Subtotal</th>
                <th>Pajak</th>
                <th>Total</th>
                <th>Metode Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $i => $booking)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $booking->studio->nama_studio ?? '-' }}</td>
                <td>{{ $booking->user->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                <td>{{ $booking->durasi_bulan }}</td>
                <td class="text-right">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($booking->tax_amount, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                <td>{{ $booking->metode_pembayaran }}</td>
                <td>{{ $booking->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>